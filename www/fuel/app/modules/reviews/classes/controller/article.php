<?php
namespace Reviews;

class Controller_Article extends \Controller_Base_Public{

  public function action_id($articleId = null){
	//array_push($this->_extraCss, "cp/blog/all");

	if($articleId == null)
		$this->ShowErrorPage("404");
	
	$article = Model_Reviews::GetArticleById($articleId);
	if($article == null)
		$this->ShowErrorPage("404");
	
	$pageInfo["title"] = $article[0]['title'];
	$pageInfo["content"] = \View::forge("fullarticle", array("articleInfo" => $article), false);
	$this->template->pageInfo = $pageInfo;
  }
}