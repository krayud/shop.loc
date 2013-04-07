<?php
class Controller_Base_Public extends Controller_Base_Main
{
	public $template = 'base/public';
	
	public function before(){
		parent::before();
		array_push($this->_extraCss, "public/main");//Стили только для публичных страниц
	}
}