<?php

class Controller_Cp_Index extends Controller_Cp_Main
{
	public function action_index()
	{
		$this->template->pageTitle = "Панель управления сайтом";
		$this->template->pageContent = "Панель управления ";
	}
}
