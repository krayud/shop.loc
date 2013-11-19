<?php
namespace Boutique;

class Controller_Ajax extends \Controller_Base_Module{
/**
* Метод добавления товара
*
*/
	public function action_addOrder(){

		if(\Input::is_ajax())
		{
		    $orderData = $_POST["orderData"];
            $orderData["cookie"]  = \Cookie::get("basket");

			$orderData["email"] = self::ClearInputData($orderData["email"]);

			if($orderData["email"] != "")
				$resultJSON = Model_Boutique::AddOrder($orderData);
			else
                $resultJSON = array('answerCode' => 2, 'answerText' => "Неверно заполнена форма");
			return json_encode($resultJSON);
		}
		else
			$this->ShowErrorPage("404");

	}

/**
* Метод обновления статуса заказа
*
*/
public function action_changeorderstatus(){

		if(\Input::is_ajax())
		{
		    $newStatusId = $_POST["newStatusId"];
            $orderId = $_POST["orderId"];
			$resultJSON = Model_Boutique::ChangeOrderStatus($newStatusId, $orderId);
			return json_encode($resultJSON);
		}
		else
			$this->ShowErrorPage("404");

	}

/**
* Очистка входящих данных от лишних пробелов, тегов, sql запросов
* 
*/
	private static function ClearInputData($var){
		$var = trim($var);
		$var = htmlspecialchars($var);
		$var = mysql_escape_string($var);
		return $var;
	}
}