<?php
namespace News;

class Model_News extends \Model_Blog {
	protected static $_table_name = 'news';
	
	
	
	public static function GetMainPageData(){
 	
	$result = \DB::select()->from('news')
		->join('news_cats')
		->on('news.cat', '=', 'news_cats.cats_id')
		->order_by('id', 'DESC')
		->execute()->as_array();
	return $result;
	
 }
}