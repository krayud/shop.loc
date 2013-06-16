<?php
namespace Questions;

class Model_Questions extends \Model_Crud {

/**
* Генерация блока для панели управления
*/
public static function GetAdminBlockData(){
	$data["header"] = "<i class='icon-question-sign'></i>Вопросы";
	$data["links"] = array(
		array("<i class='icon-info-sign'></i>Новые", "/questions/new"),
		array("<i class='icon-time'></i>Архив", "/questions/archive"),
		);
  	return $data;
}

/**
* 
* Получение списка новых вопросов
* 
*/
 public static function GetNewQuestionsLinst(){
 		$questions = \DB::select()
		->from("questions")
		->where("answer",null)
		->order_by("id","desc")
		->execute()->as_array();
		return $questions;
	}

/**
* Генерация формы вопросов
*
*/
    public static function GetQuestionForm($userInfo){
		return \View::forge("Questions::askform", array("userInfo" => $userInfo));
	}
	
/**
* Добавление вопроса
*/	
	public static function AddQuestion($question){
		//Запись вопроса
		\DB::insert('questions')->set(array(
		    'name' => $question["name"],
		    'phone' => $question["phone"],
		    'email' => $question["email"],
			'text' => $question["text"],
			'date' => time(),
		))->execute();
		
		return array('answerCode' => 0, 'answerText' => "Ваш вопрос принят, спасибо");
	}

//Отправка email
private static function SendEmail($to, $fromName, $fromEmail, $subject, $html){
	$subject = "=?utf-8?B?".base64_encode($subject)."?=";
	$headers  = "Content-type: text/html; charset=utf-8 \r\n";
	$headers  .= "From: "."=?utf-8?B?".base64_encode($fromName)."?="." <".$fromEmail.">\r\n"; 
	return mail($to, $subject, $html, $headers);
}

/**
* Добавление ответа
*/	
public static function AddAnswer($answer){
$q_info = \DB::select()->from("questions")->where("id","=",$answer["q_id"])->execute()->as_array();
$q_info[0]["answer"] = $answer["text"];

\Config::load("questions::base.ini", "base");



$to = $q_info[0]["email"]; 
$fromName = \Config::get("base.from.name");
$fromEmail = \Config::get("base.from.email");
$subject = "Ответ на вопрос";
$message = \View::forge("Questions::answer-mail", array("q_info" => $q_info[0]));

$send = self::SendEmail($to, $fromName, $fromEmail, $subject, $message);
	if($send){
	 	//Запись ответа
		$result = \DB::update('questions')
			    ->value("answer", $answer["text"])
			    ->where('id', '=', $answer["q_id"])
			    ->execute();
		if($result != 0)
			return array('answerCode' => 0, 'answerText' => "Ответ добавлен");
		else
			return array('answerCode' => 2, 'answerText' => "Ответ отправлен, но записать его в базу не удалось");
	}
	else
		return array('answerCode' => 1, 'answerText' => "Ошибка отправки email сообщения");
}

}