<?php

class Controller_Cp_Polling extends Controller_Cp_Main
{

// Добавление нового опроса
	public function action_newpolling()
	{
        $this->template->pageTitle = "Новый опрос";
		$this->template->pageContent = View::forge("cp/polling/polling-editor");
	}
	
// История всех голосований
	public function action_story()
	{
        $this->template->pageTitle = "История голосований";
		$this->template->pageContent = View::forge("cp/polling/polling-story");
	}
	
//Добавление опроса через ajax
 public function action_addnewpoll(){
 	if(Input::is_ajax()){
			$resultJSON = null;
			$newPoll["q_title"] = $this->TrimAndSqlEscape(Input::param("q_title"));
			$newPoll["options"] = $this->TrimAndSqlEscape(Input::param("options"));
			$newPoll["q_type"] = $this->TrimAndSqlEscape(Input::param("q_type"));
			$resultJSON = \Polling\Model_Polling::AddNewPoll($newPoll);	
			return json_encode($resultJSON);
			exit();
		}

		$this->ShowErrorPage("404");
 }

}
