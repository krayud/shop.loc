<?php

class Controller_Cp_Index extends Controller_Base_Controlpanel
{
	public function action_index()
	{
		$this->template->pageTitle = "Панель управления сайтом";
		$this->template->pageContent = "Панель управления ";
	}
}
