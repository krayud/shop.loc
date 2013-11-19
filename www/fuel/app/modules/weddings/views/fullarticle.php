<script>
	jQuery(document).ready(function(){
		
		
	jQuery(function(){
		jQuery(".lbimg").lightBox();
	});

		
		
	function HideAndShow(hideElement, ShowElement, time){
		jQuery(hideElement).fadeOut(time, function(){
			jQuery(ShowElement).fadeIn(time);
		});
	}


		jQuery("#photo_btn").click(function(){
			HideAndShow("#video","#photo",500);
			jQuery("#video_btn").removeClass("a_active");
			jQuery("#photo_btn").addClass("a_active");
			return false;	
		});
		
		jQuery("#video_btn").click(function(){
			HideAndShow("#photo","#video",500);
			jQuery("#photo_btn").removeClass("a_active");
			jQuery("#video_btn").addClass("a_active");
			return false;
		});
	});
</script>
<?
if($articleInfo != null)
{	
	$video = explode(";", $articleInfo[0]['video']);
	$countvideo = count($video) - 1;
	
	$photo = explode(";", $articleInfo[0]['photo']);
	$countPhoto = count($photo) - 1;
	
	if($userInfo["level"] >= 2)
		printf("<a href='%s'>Редактировать</a><br/>",
			Uri::base(false)."cp/weddings/edit/".$articleInfo[0]['id']);
			
	echo "<div class='page-content-title'>".$articleInfo[0]['title']."</div>";
	
	echo "<div class='page-content-header'>";
	
	if($countPhoto > 0)
		echo "<a href='#' class='a_active' id='photo_btn'>Фото</a> ";
	if($countvideo > 0)
		echo "• <a href='#' id='video_btn'>Видео</a> ";
	if($articleInfo[0]['review'] != "")
		echo "• <a href='".Uri::base(false)."reviews/id/".$articleInfo[0]['review']."' id='review_btn'>Отзывы</a> ";	
	echo "</div><br/>";
?>
<div id="photo-video" style="text-align: center;">
	
	<?if($countvideo > 0):?>
	<div style="display: none;" id="video">
		<?
			for($i = 0; $i < $countvideo; $i++)
				printf("%s<br/><br/>",$video[$i])
		?>
	</div>
	<?endif;?>
	
	<?if($countPhoto > 0):?>
	<div id="photo">
	
		<div id="slider">
                    
		  <div id="slider-mini"></div>
                  <div id="autoplay_btn"></div>
		  <div id="slider-content">
		    <ul>
		      
		    
		<?
			for($i = 0; $i < $countPhoto; $i++)
				printf("<li><img src='%s'/></li>", $photo[$i]);	

		?>
			 </ul>
		     <div id="previous-btn"></div>
		     <div id="forward-btn"></div>
                     
		  </div>
		</div>	
	</div>
	<?endif;?>
	
</div>
<?
}	
else
	echo "Такой записи не найдено";
?>
