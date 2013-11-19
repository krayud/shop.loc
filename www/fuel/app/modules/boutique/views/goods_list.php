<script>
  $(document).ready(function(){
     var DeleteGoodsEnable = true;

    $(".delete-goods-btn").click(function(){
        var e = this;
        var delGoodsUri = $(this).attr("id");
        if(confirm("Удалить запись?") && DeleteGoodsEnable)
        $.ajax({
		    url: delGoodsUri,
			type: "POST",
		    dataType : "json",
			beforeSend:beforeDeleteGoods,
			complete:afterDeleteGoods,
		    success: function(data){
		            if(data.answerCode == 0){
                       $(e).parent().parent().fadeOut(300);
		            }
                    else
					alert(data.answerText);
			},
			error: function(data){
				alert("Произошла ошибка во время ajax запроса "+url);
			}
		});

        return false;
   });

   function beforeDeleteGoods(){
        $("#goods-list-ajax").addClass("ajax-loading-visible");
        DeleteGoodsEnable = false;
   }
   function afterDeleteGoods(){
        DeleteGoodsEnable = true;
        $("#goods-list-ajax").removeClass("ajax-loading-visible");
   }

});
</script>
<h4>Список всех товаров</h4>
<div class="ajax-loading" id="goods-list-ajax"></div>
<br/>

<table class="table table-bordered table-hover">
	<thead>
    <tr>
      <th style="width: 30px;">ID</th>
      <th style="width: 200px;">Заголовок</th>
      <th style="width: 140px;">Категория</th>
      <th style="width: 500px;">Описание</th>
      <th style="width: 140px;">Цена</th>
	  <th style="width: 140px;">Цена со скидкой</th>
	  <th style="width: 160px;">Настройки</th>
    </tr>
  </thead>
  <tbody>
  <?

    foreach($goods as $good)
    {
    	echo "<tr>";
          echo "<td>".$good["id"]."</td>";
		 printf("<td><a href='%s'>%s</a></td>",
		 		Uri::base(false)."boutique/goods/id/".$good["id"],
				$good["title"]
		 );
			echo "<td>".$good["cat_title"]."</td>";
			echo "<td>".$good["description"]."</td>";
			echo "<td>".$good["price"]."</td>";
			echo "<td>".$good["price_discount"]."</td>";
			echo "<td>";
	          printf("<a href='%s'>Изменить</a>",
			  		Uri::base(false)."cp/boutique/edit/".$good["id"]);
	          printf(" | <a href='#' id='%s' class='delete-goods-btn'>Удалить</a>", 
			  		Uri::base(false)."cp/boutique/delete/".$good["id"]);
          	echo "</td>";
        echo "</tr>";
    }
	
?>
  </tbody>
</table>