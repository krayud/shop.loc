<?php

class Controller_Cp_Page extends Controller_Cp_Main
{
	public function action_new()
	{
		array_push($this->_extraJs, "tinymce/tinymce.min", "cp/page-new");
		$this->template->pageTitle = "Новая страница";
		$this->template->pageContent = View::forge("cp/page-editor");
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
* Тримирует и экранирует данные
* 
*/
	private function TrimAndSqlEscape($var){
		$var = trim($var);
		$var = stripslashes($var);
		return $var;
	}
}
