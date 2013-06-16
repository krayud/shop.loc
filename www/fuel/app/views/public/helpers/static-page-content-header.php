<? 
if($linkedPages != null){
	echo "<div>";
	foreach($linkedPages as $link)
		if($link["id"] == $id)
			printf("<span style='color:red;'>%s</span> &nbsp&nbsp", $link["link_text"]);
			
		else
			printf("<a href='%s'>%s</a> &nbsp&nbsp", 
					Uri::base(false)."page/".$link["uri"], $link["link_text"]);
					
	echo "</div><br/>";
}

if($content_title != null)
	echo "<div class='page-content-title'>".$content_title."</div>";
?>