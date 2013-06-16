<?php
class Controller_Base_Controlpanel extends Controller_Base_Main
{
	public $template = 'base/controlpanel'; // шаблон для панели управления
	
	public function before(){
		parent::before();
		// Если пользователь не авторизован вывод 404 ошибки
		if($this->_userInfo == null || $this->_userInfo["level"] < 2){
			$this->ShowErrorPage("404");
		}
		Cookie::set("filebrowserAccess","true"); // Открыть доступ к файловому менеджеру tinymce
		array_push($this->_extraCss, "bootstrap", 
									 "cp/template/main",
									 "cp/common",
									 "jquery/jquery-ui"
									 );	//Стили только для страниц панели управления
									 
		array_push($this->_extraJs, "jquery/jquery-ui"
									 );	//Скрипты только для страниц панели управления
									 
		
	}

}
