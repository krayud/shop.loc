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
<img src="<?=Uri::base(false).$article['img'];?>">
<br><br>
<p class="empty" align="justify">

<span style="font-size: 16px; font-family: Helios; ">
<i><?=$article['text'];?></i>
</span></p>
<? } ?>
        </div>
</section>