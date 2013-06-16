<?php
namespace Polling;

class Model_Polling extends \Model_Crud {
	

/**
* Генерация блока для панели управления
*/
public static function GetAdminBlockData(){
	$data["header"] = "<i class='icon-align-left'></i>Голосование";
	$data["links"] = array(
		array("<i class='icon-pencil'></i>Новый опрос", "/polling/newpolling"),
		array("<i class='icon-time'></i>История голосований", "/polling/story"),
		);
  	return $data;
}

/**
* Генерация блока для публичных страниц
*/
public static function GetSidebarBlock($userInfo){

	//Получение id последнего опроса
	$max_id = self::GetCurrentPollingId();
	
	if($max_id != null)
	{
		//Выборка последнего опроса
		$poll = self::GetPollingDataById($max_id);
	  	
		//Проверка на возможность голосовать (гость/авторизированный)
		if($poll[0]["q_type"] == 2 && $userInfo == null)
		{
			return ""; //Голосование доступно только зарегистрированным пользователям
		}
		else
		{
			//Голосовал ли уже пользователь
			$user_ip = $_SERVER['REMOTE_ADDR'];
			$voted = self::CheckUserVoted($max_id, $userInfo['email'], $user_ip);
			if($voted == null)
			{
				// Еще не голосовал
				return \View::forge("Polling::sidebar-block", array("poll" => $poll, "userInfo" => $userInfo));
			}
			else
			{//Голосовал, показать результаты
				$pollResult = self::GetPollingDataById($max_id);
				return \View::forge("Polling::sidebar-block-results", array("poll" => $pollResult));
			}
			
		
		}
	}
	else
	return ""; //Опросов не найдено
}

/**
* Получение id активного голосования (которое работает в данный момент)
* 
*/
private static function GetCurrentPollingId(){
	//Активное голосование - с наибольшим ID
	$max_id = \DB::query("select max(id) from polling")->execute()->as_array();
	$max_id = $max_id[0]['max(id)'];
	return $max_id;
}


/**
* Получение информации об опросе по его ID
* 
*/
private static function GetPollingDataById($pId){
	$query = \DB::query("SELECT * 
						FROM polling 
						JOIN polling_options ON polling_options.option_polling_id = polling.id
						WHERE polling.id = {$pId}");
	$poll = $query->execute()->as_array();
	return $poll; 
}


//Голосовал ли уже пользователь. Если нет то вернёт null
private static function CheckUserVoted($q_id, $email, $ip){
	$voted = \DB::query("SELECT * FROM polling_votes 
	WHERE (votes_polling_id = {$q_id}) AND (user_email = '{$email}' OR user_ip = '{$ip}')")
	->execute()->as_array();
	return $voted;
}

//Запись голоса
public static function AddVote($vote){
	
	$voted = self::CheckUserVoted($vote["q_id"], $vote["user_email"], $vote["user_ip"]);
	if($voted == null){
		//Старое значение
		$oldVoteCount = \DB::query("SELECT option_votes 
		FROM polling_options 
		WHERE option_id = {$vote['q_option']}")->execute()->as_array();
		$oldVoteCount = $oldVoteCount[0]['option_votes'];
		
		//Увеличение счетчика голосов
		$newCount = \DB::update('polling_options')
	    ->value("option_votes", $oldVoteCount+1)
	    ->where('option_id', '=', $vote['q_option'])
	    ->execute();
		
		
		//Запись в таблицу проголосовавших пользователей
		\DB::insert('polling_votes')->set(array(
		    'votes_polling_id' => $vote["q_id"],
		    'user_email' => $vote["user_email"],
		    'user_ip' => $vote["user_ip"],
		))->execute();

		$poll = self::GetPollingDataById($vote["q_id"]);
		$pollResultView = \View::forge("Polling::sidebar-block-results", array("poll" => $poll));
		return $pollResultView;
	}
}

//Добавление нового опроса
public static function AddNewPoll($newPoll){

//Вставка опроса
	list($insert_id, $rows_affected) = \DB::insert('polling')
	->columns(array(
	    'q_title',
	    'q_type',
	))
	->values(array(
	    $newPoll["q_title"],
	    $newPoll["q_type"],
	))
	->execute();
	
//Вставка вариантов ответа для опроса
$options = json_decode($newPoll["options"]);

for($i = 0; $i < count($options); $i++){
	
	$query = \DB::insert('polling_options');
	// Set the columns
	$query->columns(array(
	    'option_title',
	    'option_polling_id',
	));
	$query->values(array(
	    $options[$i],
	    $insert_id,
	));
	$query->execute();

}

	return array('answerCode' => 0, 'answerText' => "Опрос добавлен");
}

}