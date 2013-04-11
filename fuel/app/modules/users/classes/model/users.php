<?php
namespace Users;

class Model_Users extends \Model_Crud {
	protected static $_table_name = 'users';

/**
* Поиск пользователя по токену
* return array(...) или null если не найдет
*/
    public static function GetUserByToken($token){
		return Model_Users::find_one_by('token',$token);
	}
	
/**
* Попытка войти на сайт для ajax запроса. Вернёт токен пользователя или null если не получиться войти
*/ 
   public static function Login($login, $password){
   //TODO: Доделать проверку по БД, вход/ошибку
   	return false;
   }

}