<?php
class Controller_Base_Public extends Controller_Base_Main
{
	public $template = 'base/public';
	
	public function before(){
		parent::before();
		array_push($this->_extraCss, 
						"public/91ea7606", "public/7431cbeb", 
						"jquery/jquery-ui", "modules/users/forms"
						);//Стили только для публичных страниц
		array_push($this->_extraJs, "public/4379948d","jquery/jquery-ui");//Скрипты только для публичных страниц
	}
}