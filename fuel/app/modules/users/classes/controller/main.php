<?php
namespace Users;

class Controller_Main extends \Controller_Base_Module{

	private $_userInfo = null;

	function __construct(){\Config::load("users::base.ini", "base");}
	
/**
* Инициализация, вызывается из главного контроллера после добавления модул
*  Проверка авторизации пользователя и возврат 
*	array(информация о пользователе), null - если не авторизован
*/
   public function Init(){
	$cookieName =  \Config::get("base.cookie.userTokenName");
   	$token = \Cookie::get($cookieName, null);
	if($token != null)
		$this->_userInfo = Model_Users::GetUserByToken($token);
	else
		$this->_userInfo = null;
   }

/**
*	Возвращает информацию о текущем пользователе т.е. массив $this->_userInfo
*/
	public function GetUserInfo(){
		return $this->_userInfo;
	}

//ПАНЕЛЬ ПОЛЬЗОВАТЕЛЯ
/**
 * Генерация формы логина
 */
   private function _GenerateLoginForm(){
   	return \View::forge("Users::loginform");
   }
/**
 * Генерация панели пользователя
 */
   private function _GenerateUserPanel(){
   	return \View::forge("Users::userpanel",array("userInfo" => $this->_userInfo));
   }

/**
* Получение панели пользователя
*/ 
  public function GetUserPanel(){
  	if($this->_userInfo != null)
  		return $this->_GenerateUserPanel();
	else
		return $this->_GenerateLoginForm();
	
  }
}