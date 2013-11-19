<?
  if($basketData["goodsArray"])
  {
    echo "<div class='basket_content'>";

      foreach($basketData["goodsArray"] as $good)
      {
          $goodCount = $basketData["cookieData"][$good["id"]];

          $photos = explode(";", $good["photo"]);
          $photUrl = Uri::base(false)."assets/upload/goods/".$good["dir_name"]."/".$photos[0];
          $price = ($good["price_discount"] > 0 && $good["price_discount"] != NULL) ? $good["price_discount"] : $good["price"];

          printf("<div id='%s' class='good_row'>
            		<div class='good_content_left'>
            			<img class='goods_img' src='%s'>
            		</div>
            		<div class='good_content_right'>
            			<div class='good_title'><a target='_blank' href='%s'>%s</a></div>
            			<div class='good_count'>Кол-во: <input class='good_count_input' type='text' value='%s'/></div>
            			<div class='good_price'>Цена: <span class='good_price_span'>%s</span></div>
            			<div class='del_btn' id='%s'>Убрать из корзины</div>
            		</div>
            		<div class='clear'></div>
            	</div>
            	<div class='clear'></div>",
                $good["id"],
                $photUrl,
                Uri::base(false)."boutique/goods/".$good["id"],
                $good["title"],
                $goodCount,
                $price,
                $good["id"]
                );
      }
    echo "</div>";
    echo "<br/>Итого: <span class='total_sum_basket'>".$basketData["totalPrice"]."</span> рублей.<br/>";

    if($userInfo != null)
        echo "<input class='open-orderDialog-btn' type='button' value='Оформить заказ'/>";
    else
        echo "<input class='open-loginDialog-btn' type='button' value='Авторизироваться и оформить'/>";



  }
  else
    echo "В корзине нет ни одного товара.";
?>

<? if($userInfo != null && $basketData["goodsArray"]):?>
<div id="dialog-modal-newOrder" title="Оформление заказа">
	<form name="newOrder-form" action="<?=Uri::base(false);?>boutique/ajax/addOrder">
	  <label for="order-fio">ФИО</label><br/>
	  	<input id="order-fio" type="text" value=""/><br/>

      <label for="order-phone">Телефон</label><br/>
	  	<input id="order-phone" type="text" value=""/><br/>

      <label for="order-email">Email адрес для связи</label><br/>
	  	<input id="order-email" type="text" value="<?=$userInfo["email"];?>"/><br/>
     <hr>

      <label for="order-city">Город</label><br/>
	  	<input id="order-city" type="text" value=""/><br/>

      <label for="order-street">Улица</label><br/>
	  	<input id="order-street" type="text" value=""/><br/>

      <label for="order-house">Дом</label><br/>
	  	<input id="order-house" type="text" value=""/><br/>

      <label for="order-office">Квартира/офис</label><br/>
	  	<input id="order-office" type="text" value=""/><br/><br/>

      <input id='order_user_id' type="hidden" value="<?=$userInfo["id"];?>"/>

	  <center><button id="addOrder-btn" type="submit"
	  title="Оформить" class="button"><span><span>Оформить</span></span></button></center>
	</form>
</div>
<? endif;?>