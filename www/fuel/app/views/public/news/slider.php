<div id="ld-news-slider">
    <div id="ldslides" >
    <?
    if($articles != null)
    {
    	foreach($articles as $article){

    		printf("<div class='ldslide'>
    					<div class='slideWrapper'>
    						<a href='%s'><img src='%s'/></a><br/>
    						<span class='slideTitle'><a href='%s'>%s</a></span><br/>
    						<p>%s</p>
    					</div>
    	        	</div>",Uri::base(false)."news/article/id/".$article['id'],
    							Uri::base(false).$article['img'],
    							Uri::base(false)."news/article/id/".$article['id'],
    							$article['title'],
    							$article['description']
    							);
    	}
    }
    else
    	echo "<p style='text-align:left;'>Записей не найдено </p><br>";

    ?>
    </div>
</div>
 <div class="clear"></div>