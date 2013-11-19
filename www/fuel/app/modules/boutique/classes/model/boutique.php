<?php
namespace Boutique;

class Model_Boutique extends \Model_Crud {

public static $_basket = null;

//Возвращает массив с id товарами, полученный из строки json
public static function GenStrOfIdsFromJsonStr($jsonString){
    $goodsArr = json_decode($jsonString, true);
    $ids = array();
    foreach($goodsArr as $id=>$count)
        array_push($ids, $id);
        
    return $ids;
}

//Получение записей товаров в виде массива из БД из строки json ('id':'count')
public static function SelectGoodsFromBdByJson($jsonString){
    $ids = self::GenStrOfIdsFromJsonStr($jsonString);
    $result = \DB::select()->from("boutique_goods")->where('boutique_goods.id', 'IN', $ids)->as_assoc()->execute();
    return $result;
}

//Формирование общей стоимости товаров с учетом скидки. Входные данные - json строка товаров ('id':'count')
//Если уже передана строка $goodsArr - массив с записями товаров, то обращения к Бд не будет
public static function CalcTotalGoodsPrice($jsonString, $goodsArr = null){

   $goodsArr = ($goodsArr != null)? $goodsArr : self::SelectGoodsFromBdByJson($jsonString);
   $idcountArr = json_decode($jsonString, true);
   $totalPrice = 0;
   foreach($goodsArr as $good)
   {
     if($good["price_discount"] != null && $good["price_discount"] > 0)
        $totalPrice += ($good["price_discount"] * $idcountArr[$good["id"]]);
     else
        $totalPrice += ($good["price"] * $idcountArr[$good["id"]]);
   }
   return $totalPrice;
}

//Инициализация корзины, проверка кук  и т.п.
public static function BasketInit(){
   $basketCookie = \Cookie::get('basket');

   self::$_basket["totalPrice"] = 0;
   self::$_basket["totalGoodsCount"] = 0;

    if($basketCookie === null)
         \Cookie::set('basket', 'null', 60 * 60 * 24 * 30 * 2);
    else
    {
      $basketData = json_decode($basketCookie, true);
       if($basketData != null || $basketData != "")
       {
         self::$_basket["cookieData"] = $basketData;

       //Созщдание списка id товаров и выбор их из БД
       self::$_basket["goodsArray"] = self::SelectGoodsFromBdByJson($basketCookie);

       //Формирование общей цены
         self::$_basket["totalPrice"] = self::CalcTotalGoodsPrice($basketCookie, self::$_basket["goodsArray"]);

       //Подсчет общего кол-ва товаров в корзине
        self::$_basket["totalGoodsCount"] = 0;
        foreach($basketData as $id=>$count)
           self::$_basket["totalGoodsCount"] += $count;
       }
    }
}

/**
* Генерация блока корзины на страницах бутика
*/
public static function GenerateBasketMiniBlock(){
    /*
    $s = json_encode(array('1' => '5'));
    \Cookie::set('basket', $s, 60 * 30);
    */
  	return \View::forge("basket_mini", array("basketData" => self::$_basket), false);
}

/**
* Генерация контента страницы корзины
*/
public static function GenerateBasketFullPageContent($userInfo){

  	return \View::forge("basket_full", array("basketData" => self::$_basket, "userInfo" => $userInfo), false);
}

/**
* Генерация блока для панели управления
*/
public static function GetAdminBlockData(){
	$data["header"] = "<i class='icon-shopping-cart'></i>Бутик";
	$data["links"] = array(
        array("<i class='icon-list'></i>Заказы", "/boutique/orders"),
		array("<i class='icon-pencil'></i>Добавить товар", "/boutique/new"),
		array("<i class='icon-tag'></i>Категории", "/boutique/cats"),
		array("<i class='icon-eye-open'></i>Обзор всех товаров", "/boutique/list"),
		);
  	return $data;
}


/**
* Получение всех категорий из БД
*
*/
public static function GetAllCats(){
	$cats =  \DB::select()->from("boutique_cats")->execute()->as_array();
	$sortedCats = self::SortCatsBySubCats($cats);
	return $sortedCats;
}

/**
* Получение всех заказов из БД
*
*/
public static function GetAllOrders(){

	$orders = \DB::select()->from("boutique_orders")
            ->join("boutique_orders_status")
            ->on("boutique_orders.status", "=", "boutique_orders_status.stat_id")
            ->order_by("id","DESC")
            ->execute()
            ->as_array();
	return $orders;
}

/**
* Получение всех заказов конкретного пользователя из БД
*
*/
public static function GetAllOrdersByUserId($userId){

	$orders = \DB::select()->from("boutique_orders")
            ->join("boutique_orders_status")
            ->on("boutique_orders.status", "=", "boutique_orders_status.stat_id")
            ->where("boutique_orders.user_id", "=", $userId)
            ->order_by("id","DESC")
            ->execute()
            ->as_array();
	return $orders;
}

/**
* Получение заказа из БД по его id
*
*/
public static function GetOrderById($id){
	$order = \DB::select()->from("boutique_orders")
            ->where("id", $id)
            ->execute()
            ->as_array();
	return $order;
}

/**
* Списка всех статусов заказа
*
*/
public static function GetAllOrderStatus(){
	$statuses = \DB::select()->from("boutique_orders_status")
            ->execute()
            ->as_array();
	return $statuses;
}

/**
* Добавление нового заказа
*
*/
public static function AddOrder($orderData){

    $totalPrice = self::CalcTotalGoodsPrice($orderData["cookie"]);
    if($totalPrice <= 0)
        return array('answerCode' => 3, 'answerText' => "Ошибка во время добавления заказа. Неверная цена");

	$res = \DB::insert("boutique_orders")->columns(array(
	    'user_id',
        'fio',
        'phone',
		'contact_email',
        'city',
        'street',
        'house',
        'office',
        'goodsJson',
        'total_sum',
		'date'
		))->values(array(
		    $orderData["user_id"],
            $orderData["fio"],
            $orderData["phone"],
		   	$orderData["email"],
            $orderData["city"],
            $orderData["street"],
            $orderData["house"],
            $orderData["office"],
            $orderData["cookie"],
            $totalPrice,
			time()
		))->execute();

    if($res)
	    return array('answerCode' => 0, 'answerText' => "Заказ добавлен");
    else
        return array('answerCode' => 1, 'answerText' => "Ошибка во время записи данных");
}



/**
* Обновление статуса заказа
*
*/
public static function ChangeOrderStatus($newStatusId, $orderId){

    $res = \DB::update("boutique_orders")->set(array(
		    'status' => $newStatusId,
		))->where("id", $orderId)->execute();

    if($res)
	    return array('answerCode' => 0, 'answerText' => "Статус заказа обновлен");
    else
        return array('answerCode' => 1, 'answerText' => "Ошибка во время записи данных");
}

/**
* 
* Получение строки с подкатегориями ктегории parend_id
* 
*/
public static function GetSubCatStr($cats, &$subCatsStr, $parent_id = 0){

	if(empty($cats[$parent_id]))
		return;
		
	foreach($cats[$parent_id] as $cat)
	{
		$subCatsStr .= $cat['cat_id'].",";
		self::GetSubCatStr($cats, $subCatsStr, $cat['cat_id']);
	}
}


/**
* Преобразование массива категорий с учетом многоуровневых подкатегорий
* 
*/
private static function SortCatsBySubCats($cats){
	$arrCats = array(); 
	foreach($cats as $cat){
		if(empty($arrCats[$cat["parent_id"]]))
		{
			$arrCats[$cat["parent_id"]] = array();
		}
		$arrCats[$cat["parent_id"]][] = $cat;
	}
return $arrCats;
}

/**
* Получение товара по id
* 
*/
public static function GetGoodsById($goodsId){
	$allGoods = \DB::select()
				->from("boutique_goods")
				->where("id",$goodsId)
				->execute()->as_array();
return $allGoods;
}

/**
* 
* Получение всех товаров
* 
*/
public static function GetAllGoods(){
	
	$allGoods = \DB::query("SELECT * 
				FROM boutique_goods
				JOIN boutique_cats
				ON boutique_goods.cat_id = boutique_cats.cat_id
				")->execute()->as_array();
	return $allGoods;
}

/**
* 
* Получение название категории по id
* 
*/
public static function GetCatTitleById($catId){
	
	$catInfo = \DB::select()
				->from("boutique_cats")
				->where("cat_id", "=" ,$catId)
				->execute()->as_array();
	
	return $catInfo[0];
	
}

/**
* 
* Получение всех товаров в категориях.  Например: $subCatsStr = '1,2,4'
* 
*/
public static function GetsAllGoodsInCats($subCatsStr){
	
	$allGoods = \DB::query("SELECT * 
				FROM boutique_goods
				JOIN boutique_cats
				ON boutique_goods.cat_id = boutique_cats.cat_id
				WHERE boutique_goods.cat_id IN({$subCatsStr})
				")->execute()->as_array();
	return $allGoods;
}

/**
* Добавление/обновление товара
*/
public static function AddOrUpdateGoods($goodsData){
	
	if($goodsData["edited_id"] == 0)
	{
		\DB::insert("boutique_goods")->columns(array(
	    'cat_id',
		'title',
		'description',
		'photo',
		'price',
		'price_discount',
		'dir_name',
		'date'
		))->values(array(
		    $goodsData["cat"],
			$goodsData["title"],
			$goodsData["description"],
			$goodsData["photo"],
			$goodsData["goods_price"],
			$goodsData["goods_price_discount"],
			$goodsData["dir_name"],
			time(),
		))->execute();
		
		$result = array('answerCode' => 0, 'answerText' => "Товар добавлен");
	}
	else
	{
		\DB::update("boutique_goods")->set(array(
		    'cat_id' => $goodsData["cat"],
		    'title' => $goodsData["title"],
		    'description' => $goodsData["description"],
		    'photo' => $goodsData["photo"],
			'price' => $goodsData["goods_price"],
			'price_discount' => $goodsData["goods_price_discount"],
		))->where("id", $goodsData["edited_id"])->execute();
		
		$result = array('answerCode' => 0, 'answerText' => "Товар обновлен");
	}
	
return $result;
}

/**
* Удаление товара
* 
*/
public static function DeleteGoods($id){
	$result = \DB::delete("boutique_goods")->where("id", $id)->execute();
  
	if($result)
   		return array('answerCode' => 0, 'answerText' => "Товар удален");
	else
		return array('answerCode' => 1, 'answerText' => "Ошибка в процессе удаления товара");
}

/**
* Добавление категории
* 
*/
public static function AddNewCat($catData){
	
	$result = \DB::select()->from("boutique_cats")
				->where("parent_id","=", $catData["parentId"])
				->and_where("cat_title","=",$catData["newCatName"])
				->execute()->as_array();
		
	if($result == null)
	{
		$insert = \DB::insert("boutique_cats")
			->columns(array('cat_title', 'parent_id'))
			->values(array($catData["newCatName"], $catData["parentId"]))
			->execute();
		if($insert)
			return array('answerCode' => 0, 'answerText' => "Категория добавлена");
		else
			return array('answerCode' => 2, 'answerText' => "Ошибка в процессе добавления категории");
	}
	else
		return array('answerCode' => 1, 'answerText' => "Такая категори уже существует");
}

/**
* Удаление категории
* 
*/
public static function DelCat($catData){
	
	//Првоерка на наличие потомков
	$childs = \DB::select()->from("boutique_cats")
				->where("parent_id", $catData["catId"])
				->execute()->as_array();
					
	if($childs == null)
	{
		
		//Проверка на наличие товаров в данной категории
		$goods = \DB::select()->from("boutique_goods")
				->where("cat_id", $catData["catId"])
				->execute()->as_array();
				
		if($goods == null)
		{
			
			//Если нет потомков и записей - удаляем категорию
			$deletedCat = \DB::delete("boutique_cats")->where("cat_id", $catData["catId"])->execute();
			if($deletedCat)
				return array('answerCode' => 0, 'answerText' => "Категория удалена");
			else
				return array('answerCode' => 3, 'answerText' => "Ошибка в процессе удаления категории");
		}
		else
			return array('answerCode' => 2, 'answerText' => "Удалите все товары из этой категории");
	}
	else
		return array('answerCode' => 1, 'answerText' => "Сначала необходимо удалить все подкатегории");
}

}