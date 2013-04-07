<?php
class Controller_Base_Controlpanel extends Controller_Base_Main
{
	public $template = 'base/controlpanel'; // шаблон для панели управления
	
	public function before(){
		parent::before();
		
		// Если пользователь не авторизован вывод 404 ошибки
		if($this->_user == null){
			$this->ShowErrorPage("404");
		}
			
	}
	
}