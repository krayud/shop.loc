<?php
namespace Trends;

class Model_Trends extends \Model_Blog {

/**
* Получение записей для мини блока
* 
*/
	public static function GetArticleToTrendsMiniBlock(){

	$sectionId = self::GetThisSectionId("trends");

        $data = \DB::select()->from('blog')
			->where("section_id", $sectionId)
        	->and_where("display_in_mini_block", "=", 1)
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
}