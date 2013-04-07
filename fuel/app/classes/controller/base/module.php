<?php
//Базовый класс для всех модулей
class Controller_Base_Module extends Controller
{
    protected function ShowErrorPage($error, $exit = true){
	   	echo View::forge("errors/".$error);
		if($exit)
	    	exit;
    }
	
}