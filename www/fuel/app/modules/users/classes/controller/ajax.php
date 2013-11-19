<?php
namespace Users;

class Controller_Ajax extends \Controller_Base_Module{
	
/**
* Метод регистрации пользователя через ajax
*
*/
	public function action_reg(){

		if(\Input::is_ajax())
		{
			$login = $_POST["login"];
			$password = $_POST["password"];

			$login = self::ClearInputData($login);
			$password = self::ClearInputData($password);

			$resultJSON = null;
			if(strlen($password) >= 6 && filter_var($login, FILTER_VALIDATE_EMAIL))
				$resultJSON = Model_Users::Registration($login, $password);
			else
				$resultJSON = array('answerCode' => 1, 'answerText' => 'Неверно заполнена форма ');

			return json_encode($resultJSON);
		}
		else
			$this->ShowErrorPage("404");

	}
/**
* Метод авторизации пользователя через ajax
* 
*/
	public function action_auth(){
	
		if(\Input::is_ajax())
		{	
			$login = $_POST["login"];
			$password = $_POST["password"];
			
			$login = self::ClearInputData($login);
			$password = self::ClearInputData($password);

			$resultJSON = null;
			if(strlen($password) >= 6 && filter_var($login, FILTER_VALIDATE_EMAIL))
				$resultJSON = Model_Users::Authorization($login, $password);
			else
				$resultJSON = array('answerCode' => 1, 'answerText' => 'Неверно заполнена форма ');
			
			return json_encode($resultJSON);
		}
		else
			$this->ShowErrorPage("404");
		
	}

/**
* Метод для выхода с сайта
* нужен для передачи имени куки, которые следует удалить с помощью javascript
* 
*/
	public function action_logout(){
	
		if(\Input::is_ajax())
		{
			\Config::load("users::base.ini", "base");
			$cookieName = \Config::get("base.cookie.userTokenName");
			$resultJSON = array('answerCode' => 0, 'cookieName' => $cookieName);
			return json_encode($resultJSON);
		}
		else
			$this->ShowErrorPage("404");
		
	}

/**
* Очистка входящих данных от лишних пробелов, тегов, sql запросов
* 
*/
	private static function ClearInputData($var){
		$var = trim($var);
		$var = htmlspecialchars($var);
		$var = mysql_escape_string($var);
		return $var;
	}
}