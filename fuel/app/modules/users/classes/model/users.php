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
* Попытка зарегистрироваться.
*/ 
   public static function Registration($login, $password){
   	$answerArray = null;
   		if(Model_Users::find_one_by('email',$login) === null){
			$newUser = Model_Users::forge()->set(array(
			    'email' => $login,
			    'password' => md5($password),
			));
			if($newUser->save())
				$answerArray = array('answerCode' => 0, 'answerText' => 'Регистрация прошла успешно');
		}
		else
			$answerArray = array('answerCode' => 2, 'answerText' => 'Такой логин уже используется');
			
   	return $answerArray;
   }
   
/**
* Попытка авторизации.
* При успехе возвращает массив с кодом 0 и новым токеном, в противном случаи вернет массив с кодом ошибки и описанием
*/ 
   public static function Authorization($login, $password){
   	$md5Password = md5($password);
   	$answerArray = null;
   	$user = Model_Users::find_one_by(array('email'=>$login, 'password' => $md5Password));
	if($user === null)
		$answerArray = array('answerCode' => 2, 'answerText' => 'Неверный логин/пароль');
	else
	{
		\Config::load("users::base.ini", "base");
		$cookieName = \Config::get("base.cookie.userTokenName");
		$cookieTime = \Config::get("base.cookie.userTokenTimeInDays");
		
		$newToken = md5($user['id'].time());
		
		$CookieToken["name"] = $cookieName;
		$CookieToken["value"] = $newToken;
		$CookieToken["time"] = $cookieTime;

		//Обновление токена в БД 
		$user->token = $newToken;
		if($user->save()) 
			$answerArray = array('answerCode' => 0, 'answerText' => 'Авторизация прошла успешно', 'cookieToken' => $CookieToken);
		else
			$answerArray = array('answerCode' => 3, 'answerText' => 'Произошла ошибка во время обновления БД');
	}
			
   	return $answerArray;
   }   
  
}