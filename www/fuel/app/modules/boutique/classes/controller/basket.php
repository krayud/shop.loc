<?php
namespace Boutique;

class Controller_Basket extends Controller_Base{

 public function before(){
	parent::before();
    array_push($this->_extraCss,
						"modules/boutique/basket_page"
						);//Стили только для страницы корзины

    array_push($this->_extraJs, "public/basket/basket-full"
                                );

  }

  public function action_index(){
	$pageInfo["title"] = "Бутик - корзина";
	$pageInfo["content"] = Model_Boutique::GenerateBasketFullPageContent($this->_userInfo);
	$this->template->pageInfo = $pageInfo;
  }
}