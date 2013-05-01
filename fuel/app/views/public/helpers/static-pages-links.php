<?
$count = 5;
$tmp = $count;
if($links != null)
{
	foreach($links as $link){
		if($tmp == $count)
			echo "<li class='tech'><ul class='tech'>";	
		
		echo "<li class='level1 nav-1-6'><a href='/page/".$link["uri"]."'><span>".$link["link_text"]."</span></a></li>";
		
		if($tmp-- <= 1){
			$tmp = $count;
			echo "</ul></li>";
		}	
	}
	if($tmp >= 1 && $tmp < $count)
		echo "</ul></li>";		
}
else
	echo "Записей не найдено";
?>
