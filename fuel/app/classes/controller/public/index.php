<?php

class Controller_Public_Index extends Controller_Base_Public
{

    public function action_index()
    {
		if(!$this->_user)
			echo "Пользователь не авторизован";
        $this->template->pageTitle = "Главная страница";
        $this->template->pageContent = "Контент";
    }
}
