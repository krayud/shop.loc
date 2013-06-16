<?php

class Controller_Cp_Questions extends Controller_Cp_Main
{

// Новые вопросы
	public function action_new()
	{
        $this->template->pageTitle = "Новые вопросы";
		
		$questions = \Questions\Model_Questions::GetNewQuestionsLinst();
		$this->template->pageContent = View::forge("cp/questions/questions-new", array("questions" => $questions));
	}


}
