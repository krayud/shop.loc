<!DOCTYPE html>
<html>
<head>
<? require_once("helpers/cssjsattach.php"); ?>
	<title><? if(isset($pageInfo["title"])) echo $pageInfo["title"];?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="robots" content="INDEX,FOLLOW">
<link rel="icon" href="http://marinamendelson.ru/favicon.ico" type="image/x-icon">


<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>-->

<style>
#footer .footer-columns-wrapper h3, .toolbar, .page-title h1, .page-title h2, aside.sidebar section header h2, .product-view .product-prev, .product-view .product-next, aside.sidebar .sidebar-switcher, .header-slider-container .iosSlider h2, .header-slider-container .iosSlider h3, .header-slider-container .iosSlider .action-btn, .category-slider-container .iosSlider h2, .category-slider-container .iosSlider .action-btn, .catalog-product-view .product-banner h2, .catalog-product-view .product-banner p.text, .home-tabs .tabs li a, .my-wishlist .link-edit{font-family: 'Raleway', sans-serif;}
</style>

<style>
   @font-face {
    font-family: HeliosExtThin; /* Имя шрифта */
    src: url(http://marinamendelson.artdimension.ru/img_files/helioset.ttf); /* Путь к файлу со шрифтом */
    src: url(http://marinamendelson.artdimension.ru/img_files/helioset.svg); /* Путь к файлу со шрифтом */
    src: url(http://marinamendelson.artdimension.ru/img_files/helioset.otf); /* Путь к файлу со шрифтом */
   }
h2 {
    font-family: HeliosExtThin; 
    src: url(http://marinamendelson.artdimension.ru/img_files/helioset.ttf);
   }
   
}
</style>
<!-- End Font Replacement -->

<script type="text/javascript">
  jQuery(document).ready(function() { 
    jQuery('.iosSlider').iosSlider({
      responsiveSlideWidth: true,
      snapToChildren: true,
      desktopClickDrag: true,
      infiniteSlider: true,
      navSlideSelector: '.slideSelectors .button-item',
      navNextSelector: '.iosSlider .next',
      navPrevSelector: '.iosSlider .prev',
      onSlideComplete: slideComplete,
	  onSliderLoaded: sliderLoaded,
	  onSlideChange: slideChange
      , autoSlide: 1      , autoSlideTimer: 5000	  , autoSlideTransTimer: 750	  , desktopClickDrag: 1	  , infiniteSlider: 0    });
    
	
	function slideChange(args) {
	    jQuery('.slideSelectors .button-item').removeClass('selected');
	    jQuery('.slideSelectors .button-item:eq(' + args.currentSlideNumber + ')').addClass('selected');
	}
	
	function slideComplete(args) {
			
		  /* Animation */
		  jQuery(args.sliderObject).find('h2').attr('style', '');
		  jQuery(args.sliderObject).find('h3').attr('style', '');
		  jQuery(args.sliderObject).find('p.container_12').attr('style', '');
		  
		  /* left caption */
		  if(jQuery(args.currentSlideObject).hasClass('left-caption')){
			jQuery(args.currentSlideObject).children('h2').animate({
				left: '50%',
				opacity: '1'
			  }, 500, 'easeOutQuint');
		  }
		  if(jQuery(args.currentSlideObject).hasClass('left-caption')){
			jQuery(args.currentSlideObject).children('h3').animate({
				left: '50%',
				opacity: '1'
			  }, 800, 'easeOutQuint');
		  }
		  if(jQuery(args.currentSlideObject).hasClass('left-caption')){
			jQuery(args.currentSlideObject).children('p.container_12').animate({
				left: '50%',
				opacity: '1'
			  }, 950, 'easeOutQuint');
		  }
		 
		 /* right caption */
	     if(jQuery(args.currentSlideObject).hasClass('right-caption')){
			jQuery(args.currentSlideObject).children('h2').animate({
				right: '50%',
				opacity: '1'
			  }, 500, 'easeOutQuint');
		  }
		  if(jQuery(args.currentSlideObject).hasClass('right-caption')){
			jQuery(args.currentSlideObject).children('h3').animate({
				right: '50%',
				opacity: '1'
			  }, 800, 'easeOutQuint');
		  }
		  if(jQuery(args.currentSlideObject).hasClass('right-caption')){
			jQuery(args.currentSlideObject).children('p.container_12').animate({
				right: '50%',
				opacity: '1'
			  }, 950, 'easeOutQuint');
		  } 
			
	  }
	
	function sliderLoaded(args) {
		slideComplete(args);
		slideChange(args);
	}
	
	jQuery('.iosSlider div.item').each(function(){
		jQuery(this).css('backgroundImage', 'url('+ jQuery(this).find('a img').attr('src') +')');
	});
	
	
  });
</script>

</head>
<body class="none cms-index-index cms-home">
    <noscript>
        <div class="global-site-notice noscript">
            <div class="notice-inner">
                <p>
                    <strong>JavaScript seems to be disabled in your browser.</strong><br>
                    You must have JavaScript enabled in your browser to utilize the functionality of this website.                </p>
            </div>
        </div>
    </noscript>
<header id="header">
    <div class="container_12 top-container">
        <div class="grid_12">

<div id="mmlogo">
 <a title="Главная страница" href='<?=Uri::base(false);?>'><?=Asset::img('public/logo0000.png');?></a>
 </div>


<div style="float:right">
<div class="menu-button"></div>
	<ul class="links">
		<li class="first"><a href="" title="">Блог</a></li>
		<li class="first"><a href="" title="">Бутик</a></li>
		<li><a href="" title="">Школа невест</a></li>
		<li><a href="<?=Uri::base(false)?>weddings" title="">Семейный архив</a></li>
		<li class=" last"><a href="" title="" >Wishlist</a></li>
	</ul>

<br>
	<ul class="links1">
		<?=$userPanel;?>
	</ul>
</div>
			
			
				<div class="clear"></div>
        </div>
			


			
        <div class="clear"></div>
    </div>
    <div class="header-wrapper">
        <div class="container_12">




            <div class="grid_12" >

<div style="float:left">

</div>


                <nav class="nav-container" style="float:right">
    <ul class="nav-wide" id="nav" >
<li class="homepage level-top"><a class="level-top" title="Главная" href="<?=Uri::Base(false);?>"><span>۩ </span></a></li>   
     
<li class="level0 nav-1"><a href="" class="level-top"><span>Наши услуги</span></a>
<ul class="level0">
<?=$static_links_block;?>
</ul>


</li>



<li class="level0 nav-4 last level-top"><a href="" class="level-top"><span>Школа невест</span></a></li>   



<li class="level0 nav-5 last level-top"><a href="" class="level-top"><span>Интересные статьи</span></a></li>   

<li class="level0 nav-6 last level-top"><a href="" class="level-top"><span>Наши работы</span></a></li>   

</nav>
                               <div class="clear"></div>
                            </div>
            <div class="clear"></div>
        </div>
    </div>
	
<? if(Uri::segment(1) == ""):?>
<div class="header-slider-container">  
    <div class="iosSlider">	
	<div class="slider">
		<div class="item right-caption" id="item1">
		<a><?=Asset::img('public/home_sli.jpg');?></a>
		<span style="font-size: 45px; float:right; padding: 200px 50px 0px 0px; font-family: HeliosExtThin; font-color: #ff0030; ">ОРГАНИЗАЦИЯ КРАСИВЫХ СВАДЕБ</span><br>
		</div>
	</div>	
	<div class="container_12">
	    <div class="next"></div>
	    <div class="prev unselectable"></div>
	</div>
    </div>
</div>
<?endif;?>
      
</header>



<div class="content-wrapper">



    <div class="container_12">
        <div class="main-container col2-layout">


<div class="grid_9 col-main "><br><br>
	<div style="padding-left:120px; padding-right:120px; margin-top:30px; "></div>
	<? if(isset($pageInfo["contentHeader"])) echo $pageInfo["contentHeader"];?>
	<?=$pageInfo["content"];?>
</div>

<aside class="grid_3 sidebar sidebar-right">

<?=$trendsSideBar;?>

<?=$reviewsSideBar;?> 

<section class="block-subscribe">
    <header>
        <h2>Подписка на новости</h2>
    </header>
    <form action="" method="post" id="newsletter-validate-detail">
        <div class="block-content">
            <div class="form-subscribe-header">
<span style="font-size: 15px; font-family: Tahoma;">

                <label for="newsletter"><center>Введите адрес Вашей электронной почты и будьте в курсе всех последних свадебных тенденций</center></label><br>
</span>

            </div>
            <div class="input-box">
               <input type="text" name="email" id="newsletter"  title="" class="input-text required-entry validate-email" />
            </div>
            <div class="actions">
                <button type="submit" title="Подписаться" class="button"><span><span>Подписаться</span></span></button>
            </div>
        </div>
    </form>

</section>


<? if ($polling != ""):?>
<section class="block-poll">
<header>
    <h2>Свадебное голосование</h2>
</header>
<div class="block-content" id="polling-content">
	<?=$polling;?>
</div>
</section>
<? endif;?>

                            </aside>


            <div class="clear"></div>
        </div>
    </div>
</div>

<div id="services-slider-block" class="slider-block">
<div id="news-slider-block" class="slider-block">
  <h2><a href="<?=Uri::base(false)?>news">Наши услуги</a></h2>
    <div id="newsTitleDeliver"><div >&nbsp;</div></div><br/>

<div id="ld-services-slider" class="ld-slider">
    <div class="ldslides" >

<div class='ldslide'>
<div class='slideWrapper'>
<a href='#'>
<img style="float: right" onmouseover="this.src='http://marinamendelson.artdimension.ru/img_files/services/1-1.jpg';" onmouseout="this.src='http://marinamendelson.artdimension.ru/img_files/services/1-0.jpg';" src="http://marinamendelson.artdimension.ru/img_files/services/1-0.jpg" />
</a><br/>
<span class='slideTitle'><a href='#'>Организация свадьбы</a></span><br/>
</div>
</div>
		   

<div class='ldslide'>
<div class='slideWrapper'>
<a href='#'>
<img style="float: right" onmouseover="this.src='http://marinamendelson.artdimension.ru/img_files/services/2-1.jpg';" onmouseout="this.src='http://marinamendelson.artdimension.ru/img_files/services/2-0.jpg';" src="http://marinamendelson.artdimension.ru/img_files/services/2-0.jpg" />
</a><br/>
<span class='slideTitle'><a href='#'>Подача заявления в ЗАГС</a></span><br/>
</div>
</div>		   

		   
<div class='ldslide'>
<div class='slideWrapper'>
<a href='#'>
<img style="float: right" onmouseover="this.src='http://marinamendelson.artdimension.ru/img_files/services/3-1.jpg';" onmouseout="this.src='http://marinamendelson.artdimension.ru/img_files/services/3-0.jpg';" src="http://marinamendelson.artdimension.ru/img_files/services/3-0.jpg" />
</a><br/>
<span class='slideTitle'><a href='#'>Выездная регистрация</a></span><br/>
</div>
</div>		   


<div class='ldslide'>
<div class='slideWrapper'>
<a href='#'>
<img style="float: right" onmouseover="this.src='http://marinamendelson.artdimension.ru/img_files/services/4-1.jpg';" onmouseout="this.src='http://marinamendelson.artdimension.ru/img_files/services/4-0.jpg';" src="http://marinamendelson.artdimension.ru/img_files/services/4-0.jpg" />
</a><br/>
<span class='slideTitle'><a href='#'>Ведущие</a></span><br/>
</div>
</div>	

    </div>
</div>
<div class="clear"></div>
</div></div><br>

<div id="news-slider-block" class="slider-block">
  <h2><a href="<?=Uri::base(false)?>news">Новости</a></h2>
    <div id="newsTitleDeliver"><div >&nbsp;</div></div><br/>

    <?=$newsSlider;?>
</div>
<br/>

<footer id="footer">
    <div class="footer-columns-wrapper">
        <div class="container_12">
            <div class="grid_12">
                                <div style="width:250px; padding-left:20px; padding-right:10px;" class="grid_3 alpha">
<div>



    <h3>КАК НАС НАЙТИ<span></span></h3>
    <div class="title-divider"><span>&nbsp;</span></div>
    <div class="custom-footer-content">
 <br>
<p><center>
Томск, пр. Ленина, 95, ТЦ «Роман», 2 этаж<br>
Тел.: +7-913-108-97-70 и +7-913-108-97-57<br>
E-mail: mmendelson@mail.ru
</center>
</p></div> </div> 
<br>
    <h3>МЫ В СОЦИАЛЬНЫХ СЕТЯХ<span></span></h3>
    <div class="title-divider"><span>&nbsp;</span></div>
    <div class="custom-footer-content">
 <br><center>
<a href="<?=Uri::base(false);?>"><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='<?=Uri::base(false);?>assets/img/public/vks.png';" onmouseout="this.src='<?=Uri::base(false);?>assets/img/public/vk.png';" src="<?=Uri::base(false);?>assets/img/public/vk.png" width="30" height="30" alt=""></a>
<a href="<?=Uri::base(false);?>"><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='<?=Uri::base(false);?>assets/img/public/oks.png';" onmouseout="this.src='<?=Uri::base(false);?>assets/img/public/ok.png';" src="<?=Uri::base(false);?>assets/img/public/ok.png" width="30" height="30" alt=""></a>
<a href="<?=Uri::base(false);?>"><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='<?=Uri::base(false);?>assets/img/public/fs.png';" onmouseout="this.src='<?=Uri::base(false);?>assets/img/public/f.png';" src="<?=Uri::base(false);?>assets/img/public/f.png" width="30" height="30" alt=""></a>
<a href="<?=Uri::base(false);?>"><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='<?=Uri::base(false);?>assets/img/public/ts.png';" onmouseout="this.src='<?=Uri::base(false);?>assets/img/public/t.png';" src="<?=Uri::base(false);?>assets/img/public/t.png" width="30" height="30" alt=""></a>
<br/><br/>
<?=$questionForm;?>
</center>
      </div>

                               </div>






 <?=$static_links_footer_block;?>
 


<div style="width:250px; padding-right:10px; float:right;"  class="grid_3 alpha">   

</div>

<div class="clear"></div>
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="footer-bottom-wrapper">
        <div class="container_12">
            <div class="grid_12">
            <ul>
<li><a href="<?=Uri::base(false);?>">Главная</a></li>
<li><a href="">Магазин</a></li>
</ul>            <ul class="links">
                        <li class="first"><a href="">Школа невест</a></li>
                        <li class="first"><a href="">Портфолио</a></li>
                        <li class="first"><a href="">Советы</a></li>
                        <li class="first"><a href="">Наши партнёры</a></li>
                        <li class="first"><a href="">Контакты</a></li>
            </ul>
            <div class="clear"></div>
            <address>© Свадебное агентство «Марина Мендельсон», 2013</address>


			
            <div class="clear"></div>
                        </div>
            <div class="clear"></div>
        </div>
    </div>
</footer></body>
</html>
