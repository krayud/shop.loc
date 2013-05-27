<script>
  $(document).ready(function(){
     var DeletePageEnable = true;

    $(".delete-page-btn").click(function(){
      var e = this;

        var pageId = $(this).attr("id");
        var url = "<?=Uri::base(false)?>"+"cp/page/deletepage";

        if(confirm("Удалить страницу?"))
        $.ajax({
					    url: url,
						type: "POST",
					    dataType : "json",
						data:{pageId:pageId},
						beforeSend:beforeDeletePage,
						complete:afterDeletePage,
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

   function beforeDeletePage(){
        $("#pages-list-ajax").addClass("ajax-loading-visible");
        DeletePageEnable = false;
   }
   function afterDeletePage(){
        DeletePageEnable = true;
        $("#pages-list-ajax").removeClass("ajax-loading-visible");
   }

});
</script>
<h4>Список всех страниц</h4>
<div class="ajax-loading" id="pages-list-ajax"></div><br/>
<table class="table table-bordered table-hover">
	<thead>
    <tr>
      <th>URI</th>
      <th>Заголовок</th>
	  <th>Отображается в меню</th>
	  <th>Настройки</th>
    </tr>
  </thead>
  <tbody>
  <?
foreach($pages as $page){
	echo "<tr>";
      echo "<td>".$page["uri"]."</td>";
	  echo "<td>".$page["title"]."</td>";
	  	if($page["display_link"] != 0)
	  		echo "<td>Да</td>";
		else
			echo "<td>Нет</td>";

            echo "<td>";
	    	printf("<a href='%s'>Изменить</a>",Uri::base(false)."cp/page/edit/".$page["id"]);
            if($page["uri"] != "index")
                printf(" | <a href='#' id='%s' class='delete-page-btn'>Удалить</a>", $page["id"]);
		    echo "</td>";


	echo "</tr>";
}
	
?>
  </tbody>
</table>