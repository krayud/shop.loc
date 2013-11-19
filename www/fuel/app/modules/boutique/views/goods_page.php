<script type="text/javascript">

jQuery(function(){

    jQuery(".lbimg").lightBox();

});

</script>


<?
if(isset($good) && $good != null)
{
	
$photo = explode(";", $good['photo']);
?>
	
<div id="goods-block">
	<div id="goods-photo">
		
		<div id="goods-big-photo">
			<a class="lbimg" href="<?=Uri::base(false)."assets/upload/goods/".$good['dir_name']."/".$photo[0];?>">
				<img src="<?=Uri::base(false)."assets/upload/goods/".$good['dir_name']."/".$photo[0];?>"/>
			</a>

		</div>
		
		<div id="goods-mini-block">
			<?
				for($i = 1; $i < count($photo) - 1; $i++)
				{
					printf("<a class='lbimg'' href='%s'>
								<img class='goods-mini-img' src='%s'></img>
							</a>",
							Uri::base(false)."assets/upload/goods/".$good['dir_name']."/".$photo[$i],
							Uri::base(false)."assets/upload/goods/".$good['dir_name']."/".$photo[$i]
							);
				}
           ?>
			
			
			<div class="clear"></div>
		</div>
	</div>
	<div id="goods-info">
		<div id="goods-title"><?=$good['title'];?></div>
        <?
           if($good["price_discount"] > 0 && $good["price_discount"] != NULL)
           {
              echo "<div id='goods-price-old-price'><del>".number_format($good["price"], 0, ',', ' ')."</del><span id='goods-price-unit'>руб.</span></div>";
              echo "<div id='goods-price'>".number_format($good["price_discount"], 0, ',', ' ')."<span id='goods-price-unit'>руб.</span></div>";
           }
           else
             echo "<div id='goods-price'>".number_format($good["price"], 0, ',', ' ')."<span id='goods-price-unit'>руб.</span></div>";
        ?>

		<div id="<?=$good['id'];?>" class="goods-basket-btn"><?=Asset::img('public/boutique/basket-add-btn.png');?></div>
		<div class="clear"></div>
		
		
		<div id="goods-description">
			<?=$good['description'];?>
		</div>
	</div>
	<div class="clear"></div>
</div>
	
<?	
}
else
	echo "<p>Товар не найден</p>"
?>

