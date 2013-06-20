<?php
namespace Reviews;

class Controller_All extends \Controller_Base_Public{

  public function action_index(){
	
	array_push($this->_extraCss, "cp/blog/all");
	$pageInfo["title"] = "Все отзывы";
	$pageData = Model_Reviews::GetSectionMainPageData("reviews");
	$pageInfo["content"] = \View::forge("all", array("articles" => $pageData));
	$this->template->pageInfo = $pageInfo;
  }
}