<?php
namespace Boutique;

class Controller_All extends Controller_Base{
	
  public function action_index(){
	$pageInfo["title"] = "Бутик";

	$goods = Model_Boutique::GetAllGoods();
	$pageInfo["content"] = \View::forge("index");
	$this->template->pageInfo = $pageInfo;
  }
}