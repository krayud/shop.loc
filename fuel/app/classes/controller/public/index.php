<?php

class Controller_Public_Index extends Controller_Base_Public
{

    public function action_index()
    {
        $this->template->pageTitle = "Главная страница";
		$this->template->userPanel = $this->_modules["users"]->GetUserPanel();
        $this->template->pageContent = "Содержание страницы";
		$this->template->auto_filter(false);
    }
}
