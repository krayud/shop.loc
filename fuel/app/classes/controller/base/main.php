<?php

class Controller_Base_Main extends Controller_Template
{
    //PUBLIC
    public $template = null; // Основной шаблон страницы. Переопределяется в наследниках

    //PRIVATE
    private $_baseConfigFile = 'base.ini';
    private $_generalCss = null; // Стили одинаковые для ВСЕХ страниц
    private $_generalJs = array('main',"jquery/jquery");// Скрипты одинаковые для ВСЕХ страниц

    //PROTECTED
    protected $_lang;
	protected $_userInfo = null;
    protected $_extraCss = array();
    protected $_extraJs = array();
	protected $_modules = array();

    public function  before(){
        parent::before();
        Config::load($this->_baseConfigFile,'baseConfig'); // Подгрузка файла основных настроек системы
        $this->LoadLang();
		//Загрузка модулей и их инициализация
		$this->_modules["users"] = $this->GetModule('users','main'); //Создание объекта типа users
		$this->_modules["users"]->Init(); //Инициализация
		$this->_userInfo = $this->_modules["users"]->GetUserInfo();
    }

    public function after($response){
        $response = parent::after($response);
        $this->template->generalCss = $this->_generalCss;
        $this->template->generalJs = $this->_generalJs;
        $this->template->extraCss = $this->_extraCss;
        $this->template->extraJs = $this->_extraJs;
		$this->template->auto_filter(false);
        return $response;
    }

//МЕТОДЫ ОБЩИЕ ДЛЯ ВСЕХ СТРАНИЦ
/**
* Загрузка модуля.
* @module - название модуля
* @className - название класса контроллера. Без 'Controller_'!
* @return - объект класса(контроллера) модуля
*/
    protected function GetModule($module, $className){
		if(!Module::exists($module))
			return null;	
        $path = "\\".$module."\\Controller_".$className;
        Module::load($module);
        return new $path();
    }

//загрузка языка
    protected function LoadLang($lang = null){
            if($lang == null)
                $this->_lang = $this->ReadBaseConfig('system.defaultLang');
            else
                $this->_lang = $lang;
            Config::set("language",$this->_lang);
    }

/**
 * Чтение базовых настроек из 'baseConfig'
 * @$groupAndParam - 'группа.параметр'
 * 
*/  
    protected function ReadBaseConfig($groupAndParam){
            $res = Config::get("baseConfig.".$groupAndParam);
            return $res;
    }

/**
 * Редирект относительно корня
 * @$controller - контроллер редиректа
 * 
*/   
    protected function BaseRedirect($controller){
            header('Location: '.Uri::base(false).$controller,true, 302);
            exit;
    }

/**
 * Отображение страниц с ошибками и выход (exit)
 * @$error - ошибка. Например, 404
 * @$exit  - 'exit;' в конце, по умолчанию = true
 * 
*/   
    protected function ShowErrorPage($error, $exit = true){
           	echo View::forge("errors/".$error);
			if($exit)
            	exit;
    }
	
}