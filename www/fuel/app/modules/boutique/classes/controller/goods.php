<?php
namespace Boutique;

class Controller_Goods extends Controller_Base{


  public function action_id($id = null){
	if($id === null)
		$this->showErrorPage("404");

	array_push($this->_extraCss, "modules/boutique/goods_page",
								 "lightbox/css/jquery.lightbox-0.5"
								);
								
	array_push($this->_extraJs, "lightbox/js/jquery.lightbox-0.5",
                                "public/basket/basket-goods"
                                );

	$goodsData = Model_Boutique::GetGoodsById($id);	

	$pageInfo["title"] = "Обзор товара";
	$pageInfo["content"] = \View::forge("goods_page", array("good" => $goodsData[0])); 
	$this->template->pageInfo = $pageInfo;
  }
}