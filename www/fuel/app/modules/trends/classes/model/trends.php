<?php
namespace Trends;

class Model_Trends extends \Model_Blog {
	protected static $_table_name = 'news';
	
/**
* Получение записей для мини блока
* 
*/
	public static function GetArticleToTrendsMiniBlock(){

        $data = \DB::select()->from('trends')
        	->where("display_in_mini_block", 1)
        	->execute()->as_array();
        $num_rows = count($data);

          if($num_rows <= 0 || $num_rows == null){
            return null;
          }
          else{
            $rand = rand(0, $num_rows-1);
            return $data[$rand];
          }
	}

/**
* Данные одной записи (по id)
* 
*/
	public static function GetArticleById($id){

		$data = \DB::select()->from('trends')
			->where("id", $id)
			->execute()->as_array();
		return $data;
	}

/**
* Список всех записей из раздела trends
*
*/
	public static function GetMainPageData(){

	$result = \DB::select()->from('trends')
		->join('trends_cats')
		->on('trends.cat', '=', 'trends_cats.cats_id')
		->order_by('id', 'DESC')
		->execute()->as_array();
	return $result;

 }
}