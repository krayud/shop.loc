<?php

class Controller_Cp_Boutique extends Controller_Cp_Main
{

// Добавлени/обновление товара
public function action_add_update()
{
	if(Input::is_ajax())
	{
		$resultJSON = null;
		$goodsData["edited_id"] = $this->TrimAndSqlEscape(Input::param("edited_id"));
		$goodsData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
		$goodsData["cat"] = $this->TrimAndSqlEscape(Input::param("cat"));
		$goodsData["photo"] = $this->TrimAndSqlEscape(Input::param("photo"));
		$goodsData["description"] = $this->TrimAndSqlEscape(Input::param("description"));
		$goodsData["goods_price"] = $this->TrimAndSqlEscape(Input::param("goods_price"));
		$goodsData["dir_name"] = $this->TrimAndSqlEscape(Input::param("dir_name"));
		$goodsData["goods_price_discount"] = $this->TrimAndSqlEscape(Input::param("goods_price_discount"));
		
		$resultJSON = \Boutique\Model_Boutique::AddOrUpdateGoods($goodsData);

		return json_encode($resultJSON);
		exit();
	}
$this->ShowErrorPage("404");
}

// добавление категории
public function action_addcat()
{
	if(Input::is_ajax())
	{
		$resultJSON = null;
		$catData["parentId"] = $this->TrimAndSqlEscape(Input::param("parentId"));
		$catData["newCatName"] = $this->TrimAndSqlEscape(Input::param("newCatName"));
		
		$resultJSON = \Boutique\Model_Boutique::AddNewCat($catData);

		return json_encode($resultJSON);
		exit();
	}
$this->ShowErrorPage("404");
}

// удаление категории
public function action_delcat()
{
	if(Input::is_ajax())
	{
		$resultJSON = null;
		$catData["catId"] = $this->TrimAndSqlEscape(Input::param("catId"));
		
		$resultJSON = \Boutique\Model_Boutique::DelCat($catData);

		return json_encode($resultJSON);
		exit();
	}
$this->ShowErrorPage("404");
}

// Новый товар
	public function action_new()
	{
		array_push($this->_extraJs, "ajaxformuploader/js/ajaxformuploader");
		array_push($this->_extraCss, "modules/boutique/goods-editor");
		
        $this->template->pageTitle = "Добавление товара";
		
		$cats = \Boutique\Model_Boutique::GetAllCats();
		$this->template->pageContent = View::forge("boutique::goods_editor", array("cats" => $cats));
	}

// Список всех товаров
	public function action_list()
	{
        $this->template->pageTitle = "Список всех товаров";
		
		$goods = \Boutique\Model_Boutique::GetAllGoods();
		$this->template->pageContent = View::forge("boutique::goods_list", array("goods" => $goods));
	}

// Редактор категорий
	public function action_cats()
	{
        $this->template->pageTitle = "Редактирование категорий бутика";

		$cats = \Boutique\Model_Boutique::GetAllCats();
		$this->template->pageContent = View::forge("boutique::cats_editor", array("cats" => $cats));
	}

// Список заказов
	public function action_orders()
	{
        $this->template->pageTitle = "Заказы пользователей";

		$orders = \Boutique\Model_Boutique::GetAllOrders();
		$this->template->pageContent = View::forge("boutique::orders_list", array("orders" => $orders));
	}
//Редактор ордеров

    public function action_orderedit($id = null)
	{
	    if($id === null)
            $this->ShowErrorPage("404");

        $this->template->pageTitle = "Редактор заказов";

        $orderData = \Boutique\Model_Boutique::GetOrderById($id);
        if($orderData == "" || $orderData == NULL)
            $this->ShowErrorPage("404");
        $goodsArr = \Boutique\Model_Boutique::SelectGoodsFromBdByJson($orderData[0]["goodsJson"]);
        $statuses = \Boutique\Model_Boutique::GetAllOrderStatus();
        
        //Все данные в 1 массив
        $orderFullInfo["OrderJsonAsArray"] = json_decode($orderData[0]["goodsJson"], true);
        $orderFullInfo["GoodsArray"] = $goodsArr;
        $orderFullInfo["OrderData"] = $orderData[0];
        $orderFullInfo["Statuses"] = $statuses;
		$this->template->pageContent = View::forge("boutique::order-info", array("orderFullInfo" => $orderFullInfo), false);
	}

// Редактировать товар
	public function action_edit($goodsId = null)
	{
		if($goodsId === null)
			$this->ShowErrorPage("404");

         $goodsInfo = \Boutique\Model_Boutique::GetGoodsById($goodsId);

         if($goodsInfo == null)
			$this->ShowErrorPage("404");
		
		array_push($this->_extraJs, "ajaxformuploader/js/ajaxformuploader");
		array_push($this->_extraCss, "modules/boutique/goods-editor");
		
        $this->template->pageTitle = "Редактор товара";
		
		$cats = \Boutique\Model_Boutique::GetAllCats();
		$this->template->pageContent = View::forge("boutique::goods_editor", 
														array("cats" => $cats,
															  "goodsInfo" => $goodsInfo));
	}

/**
* Удаление товара через ajax
*
*/
public function action_delete($id = null){
		if(Input::is_ajax()){
			$resultJSON = null;

            if($id == null)
                $this->ShowErrorPage("404");

			$resultJSON = \Boutique\Model_Boutique::DeleteGoods($id);
			return json_encode($resultJSON);
			exit();
		}
        else
		$this->ShowErrorPage("404");
}

	
}
