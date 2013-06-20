<?php

class Controller_Cp_Weddings extends Controller_Cp_Main
{


// Список всех записей в семейном архиве
	public function action_list()
	{
		
		$this->template->pageTitle = "Все записи из семейного архива";
		$articles = \Weddings\Model_Weddings::GetMainPageData();
		$this->template->pageContent = View::forge("Weddings::articles-list", array("articles" => $articles));
	}


// Форма добавления новой записи в блог
	public function action_new()
	{
		
		array_push($this->_extraJs, "lduploader/lduploader",
									"ajaxformuploader/js/ajaxformuploader",
									"cp/weddings/article-send-form");

		array_push($this->_extraCss, "cp/blog/article-editor");

		$this->template->pageTitle = "Добавить запись в семейный архив";
		$this->template->pageContent = View::forge("Weddings::article-editor");
	}

// Форма редактирования записи свадебном ахрхиве
	public function action_edit($articleId = null)
	{
	    if($articleId === null)
			$this->ShowErrorPage("404");

         $articleInfo = \Weddings\Model_Weddings::GetArticleById($articleId);

         if($articleInfo == null)
			$this->ShowErrorPage("404");

		array_push($this->_extraJs, "lduploader/lduploader",
									"ajaxformuploader/js/ajaxformuploader",
									"cp/weddings/article-send-form");

		array_push($this->_extraCss, "cp/blog/article-editor");

		$this->template->pageTitle = "Редактирование записи в семейном архиве";
		$this->template->pageContent = View::forge("Weddings::article-editor",
													array("articleInfo" => $articleInfo)
													);
	}


/**
* Добавление новой записи в свадебный архив через ajax
*
*/
public function action_add_update(){
	if(Input::is_ajax()){
		$resultJSON = null;
		$articleData["img"] = $this->TrimAndSqlEscape(Input::param("img"));
		$articleData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
		$articleData["editId"] = $this->TrimAndSqlEscape(Input::param("editId"));
		$articleData["photo"] = $this->TrimAndSqlEscape(Input::param("photo"));
		$articleData["video"] = $this->TrimAndSqlEscape(Input::param("video"));
		$articleData["review"] = $this->TrimAndSqlEscape(Input::param("review"));
			
		$resultJSON = \Weddings\Model_Weddings::AddOrUpdateArticle($articleData);
		
		return json_encode($resultJSON);
		exit();
	}

	$this->ShowErrorPage("404");
}


/**
* Удаление записи в семейном архиве через ajax
*
*/
	public function action_delete($id = null){
		if(Input::is_ajax()){
			$resultJSON = null;

            if($id == null)
                $this->ShowErrorPage("404");

			$resultJSON = \Weddings\Model_Weddings::DeleteArticle($id);
			return json_encode($resultJSON);
			exit();
		}
        else
		$this->ShowErrorPage("404");
	}

}