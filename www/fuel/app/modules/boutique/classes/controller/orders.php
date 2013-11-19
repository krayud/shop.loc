<?php
namespace Boutique;

class Controller_Orders extends Controller_Base{

 public function before(){
	parent::before();

 /*   array_push($this->_extraCss,
						"modules/boutique/basket_page"
						);//Стили только для страницы корзины

    array_push($this->_extraJs, "public/basket/basket-full"
                                );
*/
  }

  public function action_index(){
	$pageInfo["title"] = "Бутик - мои заказы";
    $allUserOrders = Model_Boutique::GetAllOrdersByUserId($this->_userInfo["id"]);
	$pageInfo["content"] = \View::forge("user-orders", array("orders" => $allUserOrders), false);
	$this->template->pageInfo = $pageInfo;
  }
}