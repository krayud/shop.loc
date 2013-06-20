<?
if($articleInfo != null)
{	
	if($userInfo["level"] >= 2)
		printf("<a href='%s'>Редактировать</a>",
			Uri::base(false)."cp/blog/edit/".$articleInfo[0]['id']);
			
	echo "<div class='page-content-title'>".$articleInfo[0]['title']."</div>";
	echo $articleInfo[0]['text'];
}	
else
	echo "Такой записи не найдено";
?>