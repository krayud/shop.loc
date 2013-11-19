<?php
namespace Weddings;

class Controller_Article extends \Controller_Base_Public{

  public function action_id($articleId = null){
  		
	if($articleId == null)
		$this->ShowErrorPage("404");
	
	
	array_push($this->_extraCss, "modules/weddings/article_page",
								"ldslider/style"
							);
								
	array_push($this->_extraJs, "ldslider/script"
								);
	
	$article = Model_Weddings::GetArticleById($articleId);
	if($article == null)
		$this->ShowErrorPage("404");
	
	$pageInfo["title"] = $article[0]['title'];
	$pageInfo["content"] = \View::forge("fullarticle", array("articleInfo" => $article,
										"userInfo" => $this->_userInfo), false);
	$this->template->pageInfo = $pageInfo;
  }
}