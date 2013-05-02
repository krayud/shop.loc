<?
class Model_Static extends \Model_Crud {
	protected static $_table_name = 'static_pages';

/**
* Получение информации о страницы из БД
* @param uri страницы
*/
  public static function GetPageInfo($pageUri){
  	return Model_Static::find_one_by('uri', $pageUri);
  }
/**
* Возвращает данные о странице по её id
*/
  public static function GetPageInfoById($pageId){
 		return Model_Static::find_one_by('id', $pageId); 
	}
  
/**
* Генерация и возврат блока "статические страницы" для сайтбара в панели управления
*/
  public static function GetAdminBlockData(){
  	$data["header"] = "Статические страницы";
	$data["links"] = array(
		array("Создать новую", "/page/new"),
		array("Все станицы", "/page/list"),
		);
  	return $data;
  }
  
/**
* Добавление новой страницы в БД
*/
  public static function AddNewPage($pageData){
  	
	if(Model_Static::find_one_by('uri', $pageData["uri"]) === null){
		if($pageData["contentTitle"] == "") 
			$pageData["contentTitle"] = null;
		$newPage = Model_Static::forge()->set(array(
		    'uri' => $pageData["uri"],
			'display_link' => $pageData["display"],
			'link_text' => $pageData["linkText"],
		    'title' => $pageData["title"],
			'content_title' => $pageData["contentTitle"],
			'content' => $pageData["content"],
		));
		if($newPage->save())
			return array('answerCode' => 0, 'answerText' => "Страница добавлена");
		else
			return array('answerCode' => 3, 'answerText' => "Ошибка во время обработки данных");
	}
	else 
		return array('answerCode' => 2, 'answerText' => "Страница с таким адресом уже существует");
  }

/**
* Обновление страницы в БД
* 
*/
  public static function UpdatePage($pageData){
		if($pageData["contentTitle"] == "") 
			$pageData["contentTitle"] = null;
			
		$editedPage = Model_Static::find_one_by_id($pageData["editId"]);

		$editedPage->uri = $pageData["uri"];
		$editedPage->display_link = $pageData["display"];
		
		$editedPage->link_text = $pageData["linkText"];
		
		$editedPage->title = $pageData["title"];
		
		$editedPage->content_title = $pageData["contentTitle"];
		$editedPage->content = $pageData["content"];
		
		if($editedPage->save(false))
			return array('answerCode' => 0, 'answerText' => "Страница обновлена");
		else
			return array('answerCode' => 2, 'answerText' => "Ошибка во время обработки данных");
  } 
 
/**
* Генерирует блок ссылок на статические страницы
* 
*/
  public static function GenerateStaticLinksBlock(){
 		$links =  Model_Static::find_by('display_link', true);
		return View::forge("public/helpers/static-pages-links", array("links" => $links));
	}
/**
* Генерирует список всех страниц для 
*/
  public static function GeneratePagesList(){
 		$pages =  Model_Static::find_all();
		return View::forge("cp/page-list", array("pages" => $pages));
	}	

}