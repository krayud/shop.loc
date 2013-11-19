<script>

jQuery(document).ready(function(){
  var changeStatusAjax = true;
    jQuery("#order-status").change(function(){

      var newStatusId = jQuery("#order-status :selected").attr("id");
      var url = "<?=Uri::base(false)."boutique/ajax/changeorderstatus"?>";
      var orderId = "<?=$orderFullInfo["OrderData"]["id"]?>";
      if(changeStatusAjax)
      {
        $.ajax({
		    url: url,
			type: "POST",
		    dataType : "json",
			data:{newStatusId:newStatusId, orderId:orderId},
			beforeSend:beforeChangeOrderStatus,
			complete:afterChangeOrderStatus,
		    success: function(data){
					if(data.answerCode == 0)
						alert("Статус заказа обновлен");
					else
						alert(data.answerText);
			},
			error: function(data){
				alert("Произошла ошибка во время ajax запроса "+url);
			}
		});
      }
    });

function ShowAjaxLoading(display){
	if(display == true)
		$("#boutique-order-info-ajax").addClass("ajax-loading-visible");
	else
		$("#boutique-order-info-ajax").removeClass("ajax-loading-visible");
}

function beforeChangeOrderStatus(){
   changeStatusAjax = false;
   ShowAjaxLoading(true);
}

function afterChangeOrderStatus(){
   ShowAjaxLoading(false);
   changeStatusAjax = true;
}

});

</script>

<h4>Информация о заказе</h4>
<div class="ajax-loading" id="boutique-order-info-ajax"></div>
<br/>


<div id="orderblock">
    <div>Номер заказа: <?=$orderFullInfo["OrderData"]["id"]?></div>

    <label for='order-status'>Статус заказа:</label>
	<select id="order-status">
        <?
            foreach($orderFullInfo["Statuses"] as $status)
            {
                if($status["stat_id"] == $orderFullInfo["OrderData"]["status"])
                    echo "<option id='".$status["stat_id"]."'>".$status["stat_title"]."</option>";
                else
                    echo "<option id='".$status["stat_id"]."'>".$status["stat_title"]."</option>";
            }
        ?>
	</select>

	<div id="goods-list">
		<table class="table table-hover">
		  <thead>
		    <tr>
				<th>Товар</th>
				<th>Текущая стоимость</th>
				<th>Количество</th>
		    </tr>
		  </thead>
		  <tbody>
            <?
                foreach($orderFullInfo["GoodsArray"] as $good){
                  $price = ($good["price_discount"] != "" && $good["price_discount"] > 0) ? $good["price_discount"] : $good["price"];
                    printf("<tr>
                				<td><a href='%s'>%s</a></td>
                				<td>%s</td>
                				<td>%s</td>
                			</tr>",
                            Uri::base(false)."boutique/goods/".$good["id"],
                            $good["title"],
                            $price,
                            $orderFullInfo["OrderJsonAsArray"][$good["id"]]
                            );
                }
            ?>
		  </tbody>
		</table>
	</div>

	<div id="total-order-sum">Сумма заказа: <?=number_format($orderFullInfo["OrderData"]["total_sum"], 0, ',', ' ');?></div>

	<div id="contact-data">
        <div id="contact-data-title">Контактная информация:</div>
		<div id="user-fio">ФИО: <?=$orderFullInfo["OrderData"]["fio"];?></div>
		<div id="user-phone">Телефон: <?=$orderFullInfo["OrderData"]["phone"];?></div>
		<div id="user-email">Email: <?=$orderFullInfo["OrderData"]["contact_email"];?></div>
		<div id="user-city">Город: <?=$orderFullInfo["OrderData"]["city"];?></div>
		<div id="user-street">Улица: <?=$orderFullInfo["OrderData"]["street"];?></div>
		<div id="user-house">Дом: <?=$orderFullInfo["OrderData"]["house"];?></div>
		<div id="user-apartments">Квартира/офис: <?=$orderFullInfo["OrderData"]["office"];?></div>
	</div>
</div>