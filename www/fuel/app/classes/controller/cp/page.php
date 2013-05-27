<?php

class Controller_Cp_Page extends Controller_Cp_Main
{
// Форма добавления новой страницы
	public function action_new()
	{
		array_push($this->_extraJs, "tiny_mce/tiny_mce", 
									"tiny_mce/common-editor", 
									"cp/static/page-send-form");
		$this->template->pageTitle = "Новая страница";
		$this->template->pageContent = View::forge("cp/static/page-editor");
	}
//Список всех страниц
	public function action_list()
	{
		$this->template->pageTitle = "Список страниц";
		$pages = Model_Static::GetStaticPagesList("all");
		$this->template->pageContent = View::forge("cp/static/page-list", array("pages" => $pages));
		
	}
// Редактирование существующей страницы
public function action_edit($pageId)
	{
		array_push($this->_extraJs, "tiny_mce/tiny_mce",
									"tiny_mce/common-editor", 
									"cp/static/page-send-form");
		$this->template->pageTitle = "Редактирование страницы";
		$pageInfo = Model_Static::GetPageInfoById($pageId);
		if($pageInfo === null)
			$this->ShowErrorPage("404");
		$this->template->pageContent = View::forge("cp/static/page-editor", array("pageInfo" => $pageInfo));
	}	
	
/**
* Добавление новой страницы через ajax
*
*/
	public function action_add(){
		if(Input::is_ajax()){
			$resultJSON = null;

				$pageData["uri"] = $this->TrimAndSqlEscape(Input::param("pageUri"));
				$pageData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
				$pageData["contentTitle"] = $this->TrimAndSqlEscape(Input::param("contentTitle"));
				$pageData["content"] = $this->TrimAndSqlEscape(Input::param("content"));
				$pageData["linkText"] = $this->TrimAndSqlEscape(Input::param("linkText"));
				$pageData["display"] = $this->TrimAndSqlEscape(Input::param("display"));
				$reg = '/^([A-Za-z0-9-_]+)$/'; // Рег. выражение для проверки pageUri
				if(preg_match($reg, $pageData["uri"])){
					$resultJSON = Model_Static::AddNewPage($pageData);
				}
				else
				$resultJSON = array('answerCode' => 1, 'answerText' => "Некорректный адрес страницы");

			return json_encode($resultJSON);
			exit();
		}

		$this->ShowErrorPage("404");
	}
/**
* 
* Обновление информации о странице
* 
*/
	public function action_update(){
		if(Input::is_ajax()){
			$resultJSON = null;
				$pageData["editId"] = $this->TrimAndSqlEscape(Input::param("editId"));
				$pageData["uri"] = $this->TrimAndSqlEscape(Input::param("pageUri"));
				$pageData["title"] = $this->TrimAndSqlEscape(Input::param("title"));
				$pageData["contentTitle"] = $this->TrimAndSqlEscape(Input::param("contentTitle"));
				$pageData["content"] = $this->TrimAndSqlEscape(Input::param("content"));
				$pageData["linkText"] = $this->TrimAndSqlEscape(Input::param("linkText"));
				$pageData["display"] = $this->TrimAndSqlEscape(Input::param("display"));
				$reg = '/^([A-Za-z0-9-_]+)$/'; // Рег. выражение для проверки pageUri
				if(preg_match($reg, $pageData["uri"])){
					$resultJSON = Model_Static::UpdatePage($pageData);
				}
				else
				$resultJSON = array('answerCode' => 1, 'answerText' => "Некорректный адрес страницы");
				
			return json_encode($resultJSON);
			exit();
		}
			
		$this->ShowErrorPage("404");
	}

/**
* Удаление новой страницы через ajax
*
*/
	public function action_deletepage(){
		if(Input::is_ajax()){
		    $pageId = Input::param("pageId");
		    $resultJSON = Model_Static::DeletePage($pageId);
			return json_encode($resultJSON);
			exit();
		}
		$this->ShowErrorPage("404");
	}

/**
* 
* обновление контента страницы (быстрое редактирование)
* 
*/
	public function action_updatecontent(){
		if(Input::is_ajax()){
			$resultJSON = null;
				$pageData["editId"] = $this->TrimAndSqlEscape(Input::param("pageId"));
				$pageData["content"] = $this->TrimAndSqlEscape(Input::param("content"));
				
				$resultJSON = Model_Static::UpdatePageContent($pageData);
		
			return json_encode($resultJSON);
			exit();
		}
			
		$this->ShowErrorPage("404");
	}	
	
}
