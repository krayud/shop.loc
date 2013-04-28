<?php

class Controller_Public_Static extends Controller_Base_Public
{

    public function action_page($pageName = 'index')
    {
		$pageName = trim($pageName);
		$pageName = htmlspecialchars($pageName);
		$pageName = mysql_escape_string($pageName);
		//TODO: обработать $pageName, выборка данных для страницы $pageName
		
		$this->template->pageTitle = "Страница ".$pageName;
        $this->template->pageContent = "Контент статической страницы ".$pageName;
		$this->template->auto_filter(false);
    }
}
