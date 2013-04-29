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
		if($pageInfo === null) // Если страница не найдена в БД
			$this->ShowErrorPage("404");
		
		$this->template->pageInfo = $pageInfo;
		$this->template->auto_filter(false);
    }
}
