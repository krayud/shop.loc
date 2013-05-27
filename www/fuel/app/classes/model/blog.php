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
*  Получение информации о записи по её разделу и id
**/

public static function GetArticleBySectionAndId($section, $id){

	$data = DB::select()->from($section)
			->where("id", $id)
			->execute()->as_array();
		return $data;
}

/**
* Выборка всех категорий из секции
* @param  $section - секция блога, в которой выбираются категории
*
*/
public static function GetCatsInSection($section){
	return DB::select()->from($section.'_cats')->execute()->as_array();
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

/**
* Обновление новой записи в блог
*/
public static function UpdateArticle($articleData){

	DB::update($articleData["section"])->set(array(
    'title' => $articleData["title"],
    'img' => $articleData["img"],
    'description' => $articleData["description"],
    'text' => $articleData["text"],
    'cat' => $articleData["cat"],
    'display_in_mini_block' => $articleData["display_in_mini_block"],
))->where("id", $articleData["editId"])->execute();

return array('answerCode' => 0, 'answerText' => "Запись обновлена");
}

/**
* Удаление записи в блоге
*/
public static function DeleteArticle($section, $id){

   DB::delete($section)->where("id", $id)->execute();
        return array('answerCode' => 0, 'answerText' => "Запись удалена");
}

/**
* Добавление категории в раздел блога
*/
public static function AddCat($section, $newCatname){

      $result = DB::select('*')->from($section."_cats")->where("cats_title",$newCatname)->execute();
      $num_rows = count($result);
      if($num_rows == 0)  {
        list($insert_id, $rows_affected) = DB::insert($section."_cats")->columns(array('cats_title'))->values(array($newCatname))->execute();
         return array('answerCode' => 0, 'answerText' => "Категория добавлена", "insertedId" => $insert_id);
      }
      else
         return array('answerCode' => 1, 'answerText' => "Такая категория уже существует");

}

/**
* Удаление категорий в разделе блога
*/
public static function DeleteCats($section, $cat){

      $result = DB::select('*')->from($section)->where("cat",$cat)->execute();
      $num_rows = count($result);
      if($num_rows == 0)  {
              DB::delete($section."_cats")->where("cats_id", $cat)->execute();
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
    $articles = \DB::select()->from('news')
  		->join('news_cats')
  		->on('news.cat', '=', 'news_cats.cats_id')
  		->order_by('id', 'DESC')
  		->execute()->as_array();

    $result = array(
        "news" => array("section" => "news",
                        "sectionTitle" => "Новости",
                        "articles" => $articles),
        //тут добавить другие разделы блона
    );

    // $result["sector"] = "новости";
     //$result["articles"] = $articles;

      return $result;
	}

}