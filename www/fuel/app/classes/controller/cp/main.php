<?php

class Controller_Cp_Main extends Controller_Base_Controlpanel
{
	public function before(){
		parent::before();
		
		Module::load("polling");
		Module::load("questions");
		Module::load("weddings");
		
		//Генерация сайтбара
		$barModules["static"] = $this->GenerateSiteBarBlock(Model_Static::GetAdminBlockData());
		$barModules["blog"] = $this->GenerateSiteBarBlock(Model_Blog::GetAdminBlockData());
		$barModules["weddings"] = $this->GenerateSiteBarBlock(\Weddings\Model_Weddings::GetAdminBlockData());
		$barModules["polling"] = $this->GenerateSiteBarBlock(\Polling\Model_Polling::GetAdminBlockData());
		$barModules["questions"] = $this->GenerateSiteBarBlock(\Questions\Model_Questions::GetAdminBlockData());
		$barModules["users"] = $this->GenerateSiteBarBlock(\Users\Model_Users::GetAdminBlockData());
		$this->template->barModules = $barModules;
	}

/**
* Генерация блока сайтбара из данных $data
* 
* 
*/
	private function GenerateSiteBarBlock($data){
		return View::forge('cp/helpers/sitebar-block',$data,false);
	}
	
/**
* 
* Тримирует и экранирует данные
* 
*/
protected function TrimAndSqlEscape($var){
		$var = trim($var);
		$var = stripslashes($var);
		return $var;
	}
}
