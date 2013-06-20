<div class='page-content-title'>Все тренды:</div>
<?
if($articles != null)
{
	$seporator = 2;
	$tmp = 1;
	foreach($articles as $article){
		
		echo "<div class='mini-block'>";
		
		
		printf("<div class='mini-block-title'><a href='%s'>%s</a></div>
				<div class='cat-data'>%s, <a href='%s'>%s</a></div>
				<div class='mini-block-img'><img src='%s'></div>
				<div class='mini-block-description'><p>%s</p></div>
				<div class='clear'></div>
				",
				Uri::base(false)."trends/article/id/".$article["id"],
				$article["title"],
				date('d.m.Y',$article['date']),
				Uri::base(false)."trends/cat/".$article["cat_id"],
				$article["cat_title"],   
				Uri::base(false).$article["img"],
				$article["description"]
			  );
		echo "</div>";	
		
	if($tmp == $seporator){
			echo "<div class='clear'></div>";
			$tmp = 1;
		}
	else
		$tmp++;	
	}
}	
else
	echo "Записей не найдено";
?>