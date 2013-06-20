<h4>Список всех записей в семейном архиве</h4>
<?
if($articles != null){
?>

<script>
  $(document).ready(function(){
     var DeleteArticleEnable = true;

    $(".delete-article-btn").click(function(){
        var e = this;
        var delArticleUri = $(this).attr("id");
        if(confirm("Удалить запись?") && DeleteArticleEnable)
        $.ajax({
		    url: delArticleUri,
			type: "POST",
		    dataType : "json",
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
        $("#article-list-ajax").addClass("ajax-loading-visible");
        DeleteArticleEnable = false;
   }
   function afterDeletePage(){
        DeleteArticleEnable = true;
        $("#article-list-ajax").removeClass("ajax-loading-visible");
   }

});
</script>

<div class="ajax-loading" id="article-list-ajax"></div><br/>
<table class="table table-bordered table-hover">
	<thead>
    <tr>
      <th style="width: 30px;">ID</th>
      <th style="width: 200px;">Заголовок</th>
      <th style="width: 140px;">Изображение</th>
      <th style="width: 500px;">Ссылки на фотографии</th>
      <th>Ссылки на видео</th>
	  <th style="width: 160px;">Настройки</th>
    </tr>
  </thead>
  <tbody>
  <?

    foreach($articles as $article)
    {
    	echo "<tr>";
          echo "<td>".$article["id"]."</td>";
		 printf("<td><a href='%s'>%s</a></td>",
		 		Uri::base(false)."weddings/article/id/".$article["id"],
				$article["title"]
		 );
          echo "<td><img style='max-width:135px; max-height:90px;' src='".Uri::base(false).$article["img"]."'/></td>";
    	  echo "<td>".$article["photo"]."</td>";
          echo "<td>".$article["video"]."</td>";
          echo "<td>";
          printf("<a href='%s'>Изменить</a>",
		  		Uri::base(false)."cp/weddings/edit/".$article["id"]);
          printf(" | <a href='#' id='%s' class='delete-article-btn'>Удалить</a>", 
		  		Uri::base(false)."cp/weddings/delete/".$article["id"]);
          echo "</td>";
        echo "</tr>";
    }
	
?>
  </tbody>
</table>
<?
}
else
	echo "<p>В семейном архиве нет ни одной записи</p>";
?>