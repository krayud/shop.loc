<?php
namespace News;

class Model_News extends \Model_Blog {
	protected static $_table_name = 'news';
	
/**
* Получение записей для слайдера 
* 
*/
	public static function GetArticlesToNewsSlider(){

		$data = \DB::select()->from('news')
			->where("display_in_mini_block", 1)
			->order_by('id', 'DESC')
			->limit(20)
			->execute()->as_array();
		
		return $data;
	}

/**
* Данные одной записи (по id)
* 
*/
	public static function GetArticleById($id){

		$data = \DB::select()->from('news')
			->where("id", $id)
			->execute()->as_array();
		return $data;
	}

/**
* Список всех записей из раздела news
*
*/
	public static function GetMainPageData(){

	$result = \DB::select()->from('news')
		->join('news_cats')
		->on('news.cat', '=', 'news_cats.cats_id')
		->order_by('id', 'DESC')
		->execute()->as_array();
	return $result;

 }
}