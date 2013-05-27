<script>
  $(document).ready(function(){
     var DeleteArticleEnable = true;

    $(".delete-article-btn").click(function(){
        var e = this;
        var delArticleUri = $(this).attr("id");

        if(confirm("Удалить запись?"))
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
<h4>Список всех записей в блоге</h4>
<div class="ajax-loading" id="article-list-ajax"></div><br/>
<table class="table table-bordered table-hover">
	<thead>
    <tr>
      <th>ID</th>
      <th>Заголовок</th>
      <th>Изображение</th>
      <th>Краткое описание</th>
      <th>Раздел</th>
      <th>Категория</th>
	  <th>Настройки</th>
    </tr>
  </thead>
  <tbody>
  <?
foreach($articles as $sector)
    foreach($sector["articles"] as $article)
    {
    	echo "<tr>";
          echo "<td>".$article["id"]."</td>";
          echo "<td>".$article["title"]."</td>";
          echo "<td><img style='max-width:135px; max-height:90px;' src='".Uri::base(false).$article["img"]."'/></td>";
    	  echo "<td>".$article["description"]."</td>";
          echo "<td>".$sector["sectionTitle"]."</td>";
          echo "<td>".$article["cats_title"]."</td>";
          echo "<td>";
          printf("<a href='%s'>Изменить</a>",Uri::base(false)."cp/blog/edit/".$sector["section"]."/".$article["id"]);
          printf(" | <a href='#' id='%s' class='delete-article-btn'>Удалить</a>", Uri::base(false)."cp/blog/delete/".$sector["section"]."/".$article["id"]);
          echo "</td>";
        echo "</tr>";
    }
	
?>
  </tbody>
</table>