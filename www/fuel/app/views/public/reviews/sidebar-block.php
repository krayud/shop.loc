<section class="block-list block-compare">

    <header>
        <h2><a style='text-decoration:none;' href="<?=Uri::base(false)?>reviews">Отзывы</a></h2>
    </header>


    <div class="block-content">
<p class="empty">
</p>
<?
    if($article == null)
        echo "<p>Записей не найдено</p>";
    else
    {
?>
<center><h2><b><a href="<?=Uri::base(false)?>trends/article/id/<?=$article['id'];?>"><? echo $article['title'];?></a></b></h2></center>
<br>
<img style="max-width: 300px; max-height: 200px;" src="<?=Uri::base(false).$article['img'];?>">
<br><br>
<p class="empty">
	<span style="font-family: Helios;">
		<p style="text-align: justify;"><?=$article['description'];?></p>
	</span>
</p>
<? } ?>
        </div>
</section>