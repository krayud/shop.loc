<?php
namespace Weddings;

class Controller_All extends \Controller_Base_Public{

  public function action_index(){
	
	array_push($this->_extraCss, "cp/blog/all");
	$pageInfo["title"] = "Наши свадьбы";
	$pageData = Model_Weddings::GetMainPageData();
	$pageInfo["content"] = \View::forge("all", array("articles" => $pageData));
	$this->template->pageInfo = $pageInfo;
  }
}