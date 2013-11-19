<?
if(isset($catInfo))
	echo "<h1>{$catInfo['cat_title']}</h1>"
?>

<?
 if(isset($goods) && $goods != null)
 {
	foreach($goods as $good)
	{

		$str = strpos($good['photo'], ";");
		$imgName = substr($good['photo'], 0, $str);
        $price = ($good["price_discount"] > 0 && $good["price_discount"] != NULL) ? $good["price_discount"] : $good["price"];

        $priceDiv = "";
        if($good["price_discount"] > 0 && $good["price_discount"] != NULL){
           $priceDiv .= "<div class='goods_price_old'><del>".number_format($good["price"], 0, ',', ' ')."</del> <span class='goods-price-unit'>руб.</span></div>";
        }
        $priceDiv .= "<div class='goods_price'>".number_format($price, 0, ',', ' ')." <span class='goods-price-unit'>руб.</span></div>";

        printf("<div class='goods_cell'>
				<div class='goods_title'><a href='%s'>%s</a></div>
				<div class='goods_img'>
					<a class='lbimg' href='%s'>
						<img src='%s'>
					</a>
				</div>
				    %s
				</div>
				",
				Uri::base(false)."boutique/goods/".$good['id'],
				$good['title'],
				Uri::base(false)."boutique/goods/".$good['id'],
				Uri::base(false)."assets/upload/goods/".$good['dir_name']."/".$imgName,
				$priceDiv
				);
	}

 }
 else
 	echo "<p>Записей не найдено</p>";
 ?>
