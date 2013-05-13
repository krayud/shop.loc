<li>
	<a href="#"><?=$header;?></a>
	<ul>
		<?
		foreach($links as $link)
			printf("<li><a href='%s'>%s</a></li>", Uri::base(false)."cp".$link[1], $link[0]);
		?>
	</ul>
</li>