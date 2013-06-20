<?php
namespace News;

class Controller_All extends \Controller_Base_Public{

  public function action_index(){
	
	array_push($this->_extraCss, "cp/blog/all");
	$pageInfo["title"] = "Все новости";
	$pageData = Model_News::GetSectionMainPageData("news");
	$pageInfo["content"] = \View::forge("all", array("articles" => $pageData));
	$this->template->pageInfo = $pageInfo;
  }
}