<li class="nav-header"><?=$header;?></li>
<?
foreach($links as $link)
	echo "<li><a href='".Uri::base(false)."cp".$link[1]."'>".$link[0]."</a></li>";
?>
<li class="divider"></li>