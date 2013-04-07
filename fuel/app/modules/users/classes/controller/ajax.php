<?php
namespace Users;

class Controller_Ajax extends \Controller_Base_Module{

	public function action_login(){
	
		if(\Input::is_ajax())
		{	
			//TODO: обработать входящие данные и доделать логин
			$login = "";
			$password = "";
			echo Model_Users::Login($login, $password); // попотка войти, возвращает токен или fals
		}
		else
			$this->ShowErrorPage("404");
		
	}
}