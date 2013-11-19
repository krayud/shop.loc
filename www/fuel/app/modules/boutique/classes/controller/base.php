<?php
namespace Boutique;

class Controller_Base extends \Controller_Base_Public{

	public $template = 'base/public_store';
	private $_cats;
	public function before()
	{
		parent::before();
        array_push($this->_extraJs,
						"jquery/jquery.cookie",
                        "public/basket/basket-main"
						);//Стили только для страницы корзины

        Model_Boutique::BasketInit(); // Инициализация корзины (проверка кук и т.п.)
		$this->cats = Model_Boutique::GetAllCats();
		$this->template->sidebarCatsList = \View::forge("cats_list", array("cats" => $this->cats));
        $this->template->basketMini = Model_Boutique::GenerateBasketMiniBlock();
	}

}