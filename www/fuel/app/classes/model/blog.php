<?
/**
* Для создания нового раздела блога необходимо оздать соответствующую папку в modules  и унаследовать данный 
клас, добавить в БД - blog_section новую запись с назанием раздела и именем модуля
*/
class Model_Blog extends \Model_Crud {


private static $_sectionsName_id = null;

//Построение списка id модулей и их названий
public static function CreateSectionsIdList(){
	
	if(self::$_sectionsName_id === null)
	{
		$result = DB::select()->from("blog_sections")->execute()->as_array();		
		foreach($result as $section)
			self::$_sectionsName_id[$section["module_name"]] = $section["section_id"];
	}

}

//Все разделы блога могут полчить свой id в БД
public static function GetThisSectionId($moduleName){
	return self::$_sectionsName_id[$moduleName];
}


/*
//Болги на сайте (именя папок с modules и название блога должны совпадать)
private static $incBlogs = array(
	array("news", "Новости"),
    array("trends", "Тренды"),
    array("reviews", "Отзывы"),
);
*/

/**
* Возвращает список подключенныех разделов блога и их названия
*/
public static function GetBlogSections(){
	return DB::select()->from("blog_sections")->execute()->as_array();
}

/**
*  Получение информации о записи по её id
**/
public static function GetArticleById($id){

	$data = DB::select()->from("blog")
			->where("id", $id)
			->execute()->as_array();
		return $data;
}

/**
*  Получение всех записей в разделе (Можно переопределить в наследниках)
**/
public static function GetSectionMainPageData($sectionName){
	
	$sectionId = self::GetThisSectionId($sectionName);
	$result = \DB::select()->from('blog')
		->join("blog_cats")
		->on("blog_cats.cat_id", "=","blog.cat_id")
		->where("blog.section_id","=",$sectionId)
		->order_by('id', 'DESC')
		->execute()->as_array();
	return $result;

 }
 
/**
* Выборка всех категорий из секции
* @param  $section - секция блога, в которой выбираются категории
*
*/
public static function GetCatsInSection($section){
	$cats = DB::select()->from("blog_cats")
	->where("parent_section_id","=",$section)
	->execute()->as_array();

	return $cats;
}

/**
* Генерация блока для панели управления
*/
public static function GetAdminBlockData(){
	$data["header"] = "<i class='icon-edit'></i>Блог";
	$data["links"] = array(
		array("<i class='icon-pencil'></i>Добавить запись", "/blog/new"),
		array("<i class='icon-tags'></i>Категории", "/blog/cats"),
		array("<i class='icon-eye-open'></i>Обзор всех записей", "/blog/list"),
		);
  	return $data;
}

/**
* Добавление новой записи в блог
*/
public static function AddNewArticle($articleData){

	DB::insert("blog")->columns(array(
		'section_id',
		'cat_id',
	    'title',
		'img',
		'description',
		'text',
		'date',
		'display_in_mini_block'
	))->values(array(
		$articleData["section"],
		$articleData["cat"],
	    $articleData["title"],
		$articleData["img"],
		$articleData["description"],
		$articleData["text"],
		time(),
		$articleData["display_in_mini_block"],
	))->execute();
return array('answerCode' => 0, 'answerText' => "Запись добавлена");
}

/**
* Обновление новой записи в блог
*/
public static function UpdateArticle($articleData){

	DB::update("blog")->set(array(
	'section_id' => $articleData["section"],
	'cat_id' => $articleData["cat"],
    'title' => $articleData["title"],
    'img' => $articleData["img"],
    'description' => $articleData["description"],
    'text' => $articleData["text"],
    'display_in_mini_block' => $articleData["display_in_mini_block"],
))->where("id", $articleData["editId"])->execute();

return array('answerCode' => 0, 'answerText' => "Запись обновлена");
}

/**
* Удаление записи в блоге
*/
public static function DeleteArticle($id){

   DB::delete("blog")->where("id", $id)->execute();
        return array('answerCode' => 0, 'answerText' => "Запись удалена");
}

/**
* Добавление категории в раздел блога
*/
public static function AddCat($section, $newCatname){

      $result = DB::select('*')->from("blog_cats")
	  ->where("cat_title",$newCatname)
	  ->execute();
	  
      $num_rows = count($result);
	  
      if($num_rows == 0){
        list($insert_id, $rows_affected) = DB::insert("blog_cats")
		->columns(array('cat_title', 'parent_section_id'))
		->values(array($newCatname, $section))
		->execute();
		
         return array('answerCode' => 0, 'answerText' => "Категория добавлена", "insertedId" => $insert_id);
      }
      else
         return array('answerCode' => 1, 'answerText' => "Такая категория уже существует");

}

/**
* Удаление категорий в разделе блога
*/
public static function DeleteCats($section, $cat){

      $result = DB::select('*')->from("blog")
	  ->where("section_id", "=", $section)
	  ->and_where("cat_id", "=", $cat)
	  ->execute();
	  
      $num_rows = count($result);
      if($num_rows == 0)  {
              DB::delete("blog_cats")
			  ->where("parent_section_id", $section)
			  ->and_where("cat_id", "=", $cat)
			  ->execute();
         return array('answerCode' => 0, 'answerText' => "Категория удалена");
      }
      else
         return array('answerCode' => 1, 'answerText' => "Не удалось удалить категорию", "countArticles" => $num_rows);

}

 /**
* Возвращает список всех записей в блоге для админки
*/
  public static function GetArticlesList(){
    //TODO: сделать автоматическую генерация всех записей исходя из данных  $incBlogs

    $result = \DB::select()->from('blog')
  		->join('blog_cats')
  		->on('blog_cats.cat_id', '=', 'blog.cat_id')
		->join('blog_sections')
		->on('blog_sections.section_id', '=', 'blog.section_id')
  		->order_by('id', 'DESC')
  		->execute()->as_array();

      return $result;
	}

}