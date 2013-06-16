<?php
namespace Polling;

class Controller_Ajax extends \Controller_Base_Module{
	
/**
* Голосование через ajax
* 
*/
	public function action_newvote(){
	
		if(\Input::is_ajax())
		{	
			$vote["q_id"] = self::ClearInputData(\Input::param("q_id"));
			$vote["q_option"] = self::ClearInputData(\Input::param("q_option"));
			$vote["user_ip"] = self::ClearInputData(\Input::param("user_ip"));
			$vote["user_email"] = self::ClearInputData(\Input::param("user_email"));
			
			$resultJSON = Model_Polling::AddVote($vote);	
			return $resultJSON;
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