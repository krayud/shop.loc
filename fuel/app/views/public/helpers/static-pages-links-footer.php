<?
$count = 7;
$tmp = $count;
if($links != null)
{ 
	printf("<div class='grid_2'>
			 <h3>НАШИ УСЛУГИ</h3>
		    <div class='title-divider'><span>&nbsp;</span></div>
		    <div class='custom-footer-content'>
				<ul>");
	foreach($links as $link){
		if($tmp >= 1)
			printf("<li><a href='/page/%s'>%s</a></li>",$link["uri"],$link["link_text"]);
		
		if($tmp-- <= 1){
			$tmp = $count;
			echo "</ul></div></div>"; // закрыть предыдущий
			printf("<div class='grid_2'>
					<p style='padding-top:7px;'></p>
					<div class='title-divider1'><span>&nbsp;</span></div>
					<div class='custom-footer-content'><ul>");// открыть новый
		}	
	}
	if($tmp >= 1 && $tmp < $count)
		echo "</ul></div></div>"; // закрыть предыдущий		
}
else
	echo "Записей не найдено";
?>