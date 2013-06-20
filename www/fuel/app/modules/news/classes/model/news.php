<?php
namespace News;

class Model_News extends \Model_Blog {

/**
* Получение записей для слайдера 
* 
*/
public static function GetArticlesToNewsSlider(){
	$newsSectionId = self::GetThisSectionId("news");	
	
	$result = \DB::select()->from('blog')
	->where("blog.section_id","=",$newsSectionId)
	->and_where("display_in_mini_block", 1)
	->order_by('id', 'DESC')
	->limit(20)
	->execute()->as_array();

	return $result;
}
 
}