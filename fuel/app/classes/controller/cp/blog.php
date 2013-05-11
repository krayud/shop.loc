<?php

class Controller_Cp_Blog extends Controller_Cp_Main
{
	
/**
* Выборка всех категорий из секции
* @param  $section - секция блога, в которой выбираются категории
* 
*/
private function GetCatsInSection($section){
	return DB::select()->from($section.'_cats')->execute()->as_array();
}	

// Ajax запрос на генерация списка категорий в разделе Input::param("section")
public function action_ajaxGetCatList()
{
	if(Input::is_ajax()){
		$section = Input::param("section");
		$cats = $this->GetCatsInSection($section);
		$result = array("code" => 0, "catList" => $cats);
		return json_encode($result);
	}
	else
		$this->ShowErrorPage("404");
}
	
// Форма добавления новой записи в блог
	public function action_new()
	{
		array_push($this->_extraJs, "lduploader/lduploader",
									"tiny_mce/tiny_mce", 
									"tiny_mce/common-editor", 
									"cp/blog/ajax-cat-loader", 
									"cp/blog/article-send-form");
									
		array_push($this->_extraCss, "cp/blog/article-editor");
									
		$this->template->pageTitle = "Добавить запись в блог";
		$blogSections = Model_Blog::GetBlogSections();
		$this->template->pageContent = View::forge("cp/blog/article-editor", 
													array("blogSections" => $blogSections));
	}
	
/**
* Добавление новой записи в блог через ajax
* 
*/
	public function action_add(){
		if(Input::is_ajax()){
			$resultJSON = null;
				
							
				$articleData["img"] = $this->TrimAndSqlEscape(Input::param("img"));
				$articleData["editId"] = $this->TrimAndSqlEscape(Input::param("editId"));
				$articleData["section"] = $this->TrimAndSqlEscape(Input::param("section"));
				$articleData["cat"] = $this->TrimAndSqlEscape(Input::param("cat"));
				$articleData["display_in_mini_block"] = $this->TrimAndSqlEscape(Input::param("display_in_mini_block"));
				$articleData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
				$articleData["description"] = $this->TrimAndSqlEscape(Input::param("description"));
				$articleData["text"] = $this->TrimAndSqlEscape(Input::param("text"));
				
				$resultJSON = Model_Blog::AddNewArticle($articleData);
				
			return json_encode($resultJSON);
			exit();
		}
			
		$this->ShowErrorPage("404");
	}

}
