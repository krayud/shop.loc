<?php

class Controller_Public_Index extends Controller_Base_Public
{

    public function action_index()
    {
		if(!$this->_user){
			$loginForm = $this->_modules["users"]->GetLoginForm();
		}
			
        $this->template->pageTitle = "Главная страница";
        $this->template->pageContent = $loginForm;
		$this->template->auto_filter(false);
    }
}
