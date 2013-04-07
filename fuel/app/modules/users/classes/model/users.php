<?php
namespace Users;

class Model_Users extends \Model_Crud {
	protected static $_table_name = 'users';

/**
* Получение информации о пользователе по токену
* return array(...) или null если пользователь не найден
*/
    public static function GetUserByToken($token){
		return Model_Users::find_one_by('token',$token); // вернёт null если не найдет
	}
}