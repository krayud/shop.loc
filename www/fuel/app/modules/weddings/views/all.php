<div class='page-content-title'>Наши свадьбы:</div>
<?
if($articles != null)
{
	$seporator = 2;
	$tmp = 1;
	foreach($articles as $article){
		
		echo "<div class='mini-block'>";
		
		
		printf("<div class='mini-block-img'><img class='img-rounded' src='%s'></div>
				<div class='mini-block-description weddings-description'>
						<div class='mini-block-title'><a href='%s'>%s</a></div>
				</div>
				<div class='clear'></div>
				",
				Uri::base(false).$article["img"],
				Uri::base(false)."weddings/article/id/".$article["id"],
				$article["title"] 
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