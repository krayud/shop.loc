<?php

class Controller_Static extends Controller_Base_Public
{

    public function action_page($pageName = 'index')
    {
		$pageName = trim($pageName);
		$pageName = htmlspecialchars($pageName);
		$pageName = mysql_escape_string($pageName);
		
		//TODO: обработать $pageName, выборка данных для страницы $pageName
		$pageInfo = Model_Static::GetPageInfo($pageName);
		//$pageInfo = $pageData["pageInfo"];
		if($pageInfo["content"] === null) // Если страница не найдена в БД
			$this->ShowErrorPage("404");
			
		$pageInfo["contentHeader"] = View::forge("public/helpers/static-page-content-header",$pageInfo,false);
		//Добавление кнопок редактирования на страницы, если пользователь админ/редактор....
		if($this->_userInfo["level"] > 1){
			$pageInfo["content"] = View::forge("public/helpers/static-page-content", $pageInfo, false);
			array_push($this->_extraJs, "tiny_mce/tiny_mce", 
										"tiny_mce/common-editor",
										"public/fastedit-page");
		}
		$this->template->pageInfo = $pageInfo;
    }
}
