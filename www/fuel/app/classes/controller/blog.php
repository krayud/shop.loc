<?php

class Controller_Blog extends Controller_Base_Public
{

    public function action_index()
    {
		$pageInfo["title"] = "блог";
		$pageInfo["content"] = "";

		$this->template->pageInfo = $pageInfo;
    }
    
    
}