<?
class Model_Static extends \Model_Crud {
	protected static $_table_name = 'static_pages';

/**
* Получение информации о страницы из БД
* @param uri страницы
* 
*/
  public static function GetPageInfo($pageUri){
  	return Model_Static::find_one_by('uri', $pageUri);
  }
  
  /**
  * Генерация и возврат блока "статические страницы" для сайтбара в панели управления
  * 
  * 
*/
  public static function GetAdminBlockData(){
  	$data["header"] = "Статические страницы";
	$data["links"] = array(
		array("Добавить", "/page/new"),
		array("Редактировать", "/page/edit"),
		);
  	return $data;
  }
}