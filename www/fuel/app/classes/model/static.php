<?
class Model_Static extends \Model_Crud {
	protected static $_table_name = 'static_pages';

/**
* Получение информации о страницы из БД
* @param uri страницы
*/
  public static function GetPageInfo($pageUri){
  	$pageInfo = Model_Static::find_one_by('uri', $pageUri);
	
	
	if($pageInfo["group"] != 0){
		$queryLink = DB::select()->from('static_pages');
			$queryLink->where("static_pages.group", $pageInfo["group"]);
		$linkedPages = $queryLink->execute()->as_array();
		$pageInfo["linkedPages"] = $linkedPages; 
	}
	else
		$pageInfo["linkedPages"] = null; 
	
	
	return $pageInfo;
  }
/**
* Возвращает данные о странице по её id
*/
  public static function GetPageInfoById($pageId){
 		return Model_Static::find_one_by('id', $pageId); 
	}
 
/**
* Возвращает список всех групп для страниц
*/
  public static function GetStaticGroups(){
 		return DB::select()->from("static_groups")->execute()->as_array();
	}
  
/**
* Генерация и возврат блока "статические страницы" для сайтбара в панели управления
*/
  public static function GetAdminBlockData(){
  	$data["header"] = "<i class='icon-file'></i>Страницы";
	$data["links"] = array(
		array("<i class='icon-pencil'></i>Добавить страницу", "/page/new"),
		array("<i class='icon-eye-open'></i>Обзор всех страниц", "/page/list"),
		array("<i class='icon-pencil'></i>Радактор групп", "/page/groups"),
		);
  	return $data;
  }
  
  
  
/**
* Добавление новой группы для статических страниц
*/
  public static function AddNewGroup($newGroupName){
  	
	
	$selectSameGroup = DB::select()->from("static_groups")->where('title',$newGroupName)->execute();
	$num_rows = count($selectSameGroup);
	
	if($num_rows != 0)
		return array('answerCode' => 2, 'answerText' => "Такая группа уже существует");
	else{
		list($insert_id, $rows_affected) = DB::insert("static_groups")->columns(array('title'))->values(array($newGroupName))->execute();
 
 
 return array('answerCode' => 0, 'answerText' => "Группа добавлена", "insertedId" => $insert_id);
		 
	}
		
  }

/**
* Удаление группы для статических страниц
*/
  public static function DeleteGroup($group){

	DB::update("static_pages")
	->value('group', 0)
	->where("group", $group)
	->execute();

	DB::delete("static_groups")->where("id", $group)->execute();
	
 	return array('answerCode' => 0, 'answerText' => "Группа удалена");
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
			'group' => $pageData["page_group"],
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
		$editedPage->group = $pageData["page_group"];
		$editedPage->display_link = $pageData["display"];
		$editedPage->link_text = $pageData["linkText"];
		$editedPage->title = $pageData["title"];
		$editedPage->content_title = $pageData["contentTitle"];
		$editedPage->content = $pageData["content"];
		
		if($editedPage->save(false))
			return array('answerCode' => 0, 'answerText' => "Страница обновлена");
		else
			return array('answerCode' => 2, 'answerText' => "Страница не была изменена");
  }
  
 /**
* Обновление только контента у страницы с id = $pageData[id]
*
*/
  public static function UpdatePageContent($pageData){

		$editedPage = Model_Static::find_one_by_id($pageData["editId"]);

		if($editedPage["content"] == $pageData["content"])
			return array('answerCode' => 1, 'answerText' => "Страница не была изменена");

		$editedPage->content = $pageData["content"];

		if($editedPage->save(false))
			return array('answerCode' => 0, 'answerText' => "Страница обновлена");
		else
			return array('answerCode' => 2, 'answerText' => "Ошибка во время обработки данных");
  }

/**
* Удаление страницы по ID
*
*/
  public static function DeletePage($pageId){

    DB::delete("static_pages")->where("id", $pageId)->execute();
        return array('answerCode' => 0, 'answerText' => "Страница удалена");
  }

 
/**
* Возвращает список статических страниц в зависимости от фильтра
* $filter = all|visible|hidden - все|отображаемые ссыки|ссылки не отображаются
*/
  public static function GetStaticPagesList($filter){
  		switch($filter){
		  	case "all":
				return Model_Static::find_all();
		  	break;
			case "visible":
				return Model_Static::find_by('display_link', true);
		  	break;
			case "hidden":
				return Model_Static::find_by('display_link', false);
		  	break;
		  	default:
				return null;
		  	break;
		  } 
	}	

}