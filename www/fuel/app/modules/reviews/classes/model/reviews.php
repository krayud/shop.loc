<?php
namespace Reviews;

class Model_Reviews extends \Model_Blog {
	protected static $_table_name = 'news';

/**
* Получение записей для мини блока
* 
*/
	public static function GetArticleToReviewsMiniBlock(){

        $data = \DB::select()->from('reviews')
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

		$data = \DB::select()->from('reviews')
			->where("id", $id)
			->execute()->as_array();
		return $data;
	}

/**
* Список всех записей из раздела reviews
*
*/
	public static function GetMainPageData(){

	$result = \DB::select()->from('reviews')
		->join('reviews_cats')
		->on('reviews.cat', '=', 'reviews_cats.cats_id')
		->order_by('id', 'DESC')
		->execute()->as_array();
	return $result;

 }
}