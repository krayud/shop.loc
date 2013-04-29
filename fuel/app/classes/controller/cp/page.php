<?php

class Controller_Cp_Page extends Controller_Cp_Main
{
	public function action_new()
	{
		array_push($this->_extraJs, "tinymce/tinymce.min");
		$this->template->pageTitle = "Новая страница";
		$this->template->pageContent = View::forge("cp/page-new");
	}
}
