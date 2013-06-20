<?php
namespace Weddings;

class Model_Weddings extends \Model_Blog {

/**
* Генерация блока для панели управления
*/
public static function GetAdminBlockData(){
	$data["header"] = "<i class='icon-folder-open'></i>Семейный архив";
	$data["links"] = array(
		array("<i class='icon-pencil'></i>Добавить", "/weddings/new"),
		array("<i class='icon-eye-open'></i>Все записи", "/weddings/list"),
		);
  	return $data;
}


/**
* Данные одной записи (по id)
* 
*/
	public static function GetArticleById($id){

		$data = \DB::select()->from('weddings')
			->where("id", $id)
			->execute()->as_array();
		return $data;
	}

/**
* Список всех записей из раздела Семейный архив
*
*/
	public static function GetMainPageData(){

	$result = \DB::select()->from('weddings')
		->order_by('id', 'DESC')
		->execute()->as_array();
	return $result;

 }
 
/**
* Добавление новой записи в "наши свадьбы"
*/
public static function AddOrUpdateArticle($articleData){
	
	if($articleData["editId"] == 0)
	{
		\DB::insert("weddings")->columns(array(
	    'title',
		'img',
		'photo',
		'video',
		'review',
		'date',
		))->values(array(
		    $articleData["title"],
			$articleData["img"],
			$articleData["photo"],
			$articleData["video"],
			$articleData["review"],
			time(),
		))->execute();
		
		$result = array('answerCode' => 0, 'answerText' => "Запись добавлена");
	}
	else
	{
		\DB::update("weddings")->set(array(
		    'title' => $articleData["title"],
		    'img' => $articleData["img"],
		    'photo' => $articleData["photo"],
		    'video' => $articleData["video"],
			'review' => $articleData["review"],
		))->where("id", $articleData["editId"])->execute();
		
		$result = array('answerCode' => 0, 'answerText' => "Запись обновлена");
	}
	
return $result;
}

/**
* Удаление записи в семейном архиве
*/
public static function DeleteArticle($id){
  $result = \DB::delete("weddings")->where("id", $id)->execute();
  
	if($result)
   		return array('answerCode' => 0, 'answerText' => "Запись удалена");
	else
		return array('answerCode' => 1, 'answerText' => "Ошибка в процессе удаления записи");
}

}