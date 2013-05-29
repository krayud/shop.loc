<?
if($articleInfo != null)
{	
	echo "<div class='page-content-title'>".$articleInfo[0]['title']."</div>";
	echo $articleInfo[0]['text'];
}	
else
	echo "Такой записи не найдено";
?>