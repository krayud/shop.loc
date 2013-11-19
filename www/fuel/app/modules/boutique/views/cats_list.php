<style>
	li{
		padding-left:15px;
	}
</style>
<?

function PrintCatsByParentId($cats, $parent_id = 0){
static $level = -1; // Уровень вложенности категории

	if(empty($cats[$parent_id]))
		return;
		
	$level++;
	echo "<ul>";
	foreach($cats[$parent_id] as $cat){
	
		printf("<li><a href='%s'>%s</a>", Uri::base(false)."boutique/cat/".$cat['cat_id'],$cat['cat_title']);
		PrintCatsByParentId($cats, $cat['cat_id']);
		echo "</li>";
		
	}
	echo "</ul>";	
	$level--;
}
?>
<section class="block-poll">
<header>
    <h2>Категории магазина</h2>
</header>
<div class="block-content">
	<?=PrintCatsByParentId($cats, 0);?>
</div>
</section>