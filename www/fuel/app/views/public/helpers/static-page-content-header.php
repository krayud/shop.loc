<? 
if($linkedPages != null){
	echo "<div class='page-content-header'>";
	
	//foreach($linkedPages as $link)
	$pageCount = count($linkedPages);
	for($i = 0; $i < $pageCount; $i++){
		if($linkedPages[$i]["id"] == $id)
			printf("<a href='%s' class='a_active'>%s</a> ",
						Uri::base(false)."page/".$linkedPages[$i]["uri"],
						 $linkedPages[$i]["link_text"]);
		else
			printf("<a href='%s'>%s</a> ", 
					Uri::base(false)."page/".$linkedPages[$i]["uri"], $linkedPages[$i]["link_text"]);
					
		if($i != $pageCount -1)
		echo " • ";
	}
					
	echo "</div><br/>";
}

if($content_title != null)
	echo "<div class='page-content-title'>".$content_title."</div>";
?>