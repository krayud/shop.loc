<?php

class Controller_Cp_Index extends Controller_Cp_Main
{
	public function action_index()
	{
		$this->template->pageTitle = "Панель управления сайтом";

        $orders = \Boutique\Model_Boutique::GetAllOrders();
		$this->template->pageContent = View::forge("boutique::orders_list", array("orders" => $orders));
	}
}
