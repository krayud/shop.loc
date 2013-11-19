<?php
namespace Boutique;

class Controller_Cat extends Controller_Base{
	
  public function action_id($catId = null){
  
  	if($catId === null)
		$this->ShowErrorPage("404");
  	
	array_push($this->_extraCss, "modules/boutique/goods_all",
								 "lightbox/css/jquery.lightbox-0.5"
								);
								
	array_push($this->_extraJs, "lightbox/js/jquery.lightbox-0.5"
								);
								
	$pageInfo["title"] = "Бутик";
	
	$subCatsStr = "";
	Model_Boutique::GetSubCatStr($this->cats, $subCatsStr, $catId);
	$subCatsStr .= $catId;
	
	
	$catInfo = Model_Boutique::GetCatTitleById($catId);
	
	$goods = Model_Boutique::GetsAllGoodsInCats($subCatsStr);
	$pageInfo["content"] = \View::forge("all", array("subCatsStr" => $subCatsStr, 
													 "goods" => $goods,
													 "catInfo" => $catInfo
													 )); 
	$this->template->pageInfo = $pageInfo;
  }
}