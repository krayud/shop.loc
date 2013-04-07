<?php
namespace Users;

class Controller_Main extends \Controller_Base_Module{

	function __construct(){
		\Config::load("users::base.ini", "base");
	}
/**
*  Проверка авторизации пользователя и возврат 
*	array(информация о пользователе), null - если не авторизован
*/
   public function Init(){
	$cookieName =  \Config::get("base.cookie.userTokenName");
   	$token = \Cookie::get($cookieName, null);
	if($token != null)
		return Model_Users::GetUserByToken($token);
	else
		return null;
   }
   
 /**
 * Запрос формы для входа на сайт
 */
   public function GetLoginForm(){
   	return \View::forge("Users::loginform");
   }

}