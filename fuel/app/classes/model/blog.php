<?
/**
* Для создания нового раздела блога необходимо оздать соответствующую папку в modules  и унаследовать данный 
клас, добавить в $incBlogs новый элемент с именем нового раздела блога
*/
class Model_Blog extends \Model_Crud {


//Болги на сайте (именя папок с modules и название блога должны совпадать)
private static $incBlogs = array(
	array("news", "Новости"),
);

/**
* Возвращает список подключенныех разделов блога и их названия
*/
public static function GetBlogSections(){
	return static::$incBlogs;
}

/**
* Генерация блока для панели управления
*/
public static function GetAdminBlockData(){
	$data["header"] = "Модуль блога";
	$data["links"] = array(
		array("Новая запись", "/blog/new"),
		array("Категории", "/blog/cats"),
		array("Все записи", "/blog/list"),
		);
  	return $data;
}

/**
* Добавление новой записи в блог
*/
public static function AddNewArticle($articleData){

	DB::insert($articleData["section"])->columns(array(
	    'title', 
		'img', 
		'description', 
		'text', 
		'date',
		'cat', 
		'display_in_mini_block'
	))->values(array(
	    $articleData["title"], 
		$articleData["img"],
		$articleData["description"],
		$articleData["text"],
		time(),
		$articleData["cat"],
		$articleData["display_in_mini_block"],
	))->execute();
return array('answerCode' => 0, 'answerText' => "Запись добавлена");
}



}