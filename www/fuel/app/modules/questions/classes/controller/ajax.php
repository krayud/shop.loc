<?php
namespace Questions;

class Controller_Ajax extends \Controller_Base_Module{
	
/**
* Задать вопрос
* 
*/
	public function action_addnewquestion(){
	
		if(\Input::is_ajax())
		{	
			$question["name"] = self::ClearInputData(\Input::param("name"));
			$question["phone"] = self::ClearInputData(\Input::param("phone"));
			$question["email"] = self::ClearInputData(\Input::param("email"));
			$question["text"] = self::ClearInputData(\Input::param("text"));

			$resultJSON = Model_Questions::AddQuestion($question);

			return json_encode($resultJSON);
		}
		else
			$this->ShowErrorPage("404");
		
	}


/**
* Добавить ответ на вопрос
* 
*/
	public function action_addanswer(){
	
		if(\Input::is_ajax())
		{	
			$answer["q_id"] = self::ClearInputData(\Input::param("q_id"));
			$answer["text"] = self::ClearInputData(\Input::param("answer"));

			$resultJSON = Model_Questions::AddAnswer($answer);

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