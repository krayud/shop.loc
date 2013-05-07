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

<div id="mmlogo"><?=Asset::img('public/logo0000.png');?></div>


<div style="float:right">
<div class="menu-button"></div>
	<ul class="links">
		<li class="first"><a href="" title="">Блог</a></li>
		<li class="first"><a href="" title="">Бутик</a></li>
		<li><a href="" title="">Школа невест</a></li>
		<li><a href="" title="">Семейный архив</a></li>
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
<li class="homepage level-top active"><a class="level-top" title="Главная" href="<?=Uri::Base(false);?>"><span>۩ </span></a></li>   
     
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
</header>



<div class="content-wrapper">



    <div class="container_12">
        <div class="main-container col2-layout">


<div class="grid_9 col-main "><br><br>
	<div style="padding-left:120px; padding-right:120px; margin-top:30px; "> 
		<?=$pageInfo["content"];?>
	</div>
</div>

<aside class="grid_3 sidebar sidebar-right">

<section class="block-list block-compare">

    <header>
        <h2>Тренды</h2>
    </header>


    <div class="block-content">
<p class="empty">
</p>

<center><h2><b>Мужчина и твоя идеальная свадьба. Как совместить несовместимое.</b></h2></center>
<br>
<img src="
http://idealnaya-svadba.com.ua/files/data/image/olga/8.jpg">
<br><br>
<p class="empty" align="justify">

<span style="font-size: 16px; font-family: Helios; ">
<i>В последнее время всё чаще в наше агентство по организации свадеб стали обращаться мужчины... Новая модная тенденция или нечто другое???</i>
</span></p>
        </div>
</section>


<section class="block-list block-compare">
    <header>
        <h2>Отзывы</h2>
    </header>
    <div class="block-content">
<p class="empty">
</p>

<center><span style="font-size: 17px; font-family: HeliosExtThin; "><b>Ольга и Алексей</b></span></center>
<br>
<img src="http://idealnaya-svadba.com.ua/files/data/image/otzyvy/22_0002.jpg">
<br><br><p align="justify">
<span style="font-size: 15px; font-family: Tahoma; ">
<i>Изначально я очень скептически относилась к свадебным агентствам, но по итогу могу с уверенностью сказать «Марина Мендельсон» - свадебное агентство премиум класса</i>
</span></p>
        </div>
</section>



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
               <input type="text" name="email" id="newsletter" title="" class="input-text required-entry validate-email" />
            </div>
            <div class="actions">
                <button type="submit" title="Подписаться" class="button"><span><span>Подписаться</span></span></button>
            </div>
        </div>
    </form>

</section>



<section class="block-poll">
    <header>
        <h2>Свадебное голосование</h2>
    </header>
    <form id="pollForm" action="" method="post" onsubmit="return validatePollAnswerIsSelected();">
        <div class="block-content">
            <p class="block-subtitle">Как вы планируете провести медовый месяц?</p>
                        <ul id="poll-answers">
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_1" value="1" />
                    <span class="label"><label for="vote_1">Классический отдых за границей</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_2" value="2" />
                    <span class="label"><label for="vote_2">Планируем экзотическое путешествие</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_3" value="3" />
                    <span class="label"><label for="vote_3">На море в России или Украине</label></span>
                </li>
                                <li>
                    <input type="radio" name="vote" class="radio poll_vote" id="vote_4" value="4" />
                    <span class="label"><label for="vote_4">Не поедем в свадебное путешествие</label></span>
                </li>
                            </ul>
            <script type="text/javascript">decorateList('poll-answers');</script>
                        <div class="actions">
                <button type="submit" title="Отправить" class="button"><span><span>Отправить</span></span></button>
            </div>
        </div>
    </form>
</section>


                            </aside>


            <div class="clear"></div>
        </div>
    </div>
</div>



<center>

<div style="padding-left:55px; width: 1200px; ">

<aside class="grid_3 sidebar ">

<section class="block-list block-compare">

    <header>
        <h2>Новости</h2>
    </header>

<br>
<div style="padding: 15px; width: 245px; display: inline-block; ">

<img style="float: left; padding-right: 5px; padding-bottom: 5px;" src="http://idealnaya-svadba.com.ua/files/data/image/olga/8.jpg"><br>
<p align="justify"><span style="font-size: 12px; font-family: Tahoma; ">Предположительно здесь будет расположен текст определённой новости. В идеале планируется сделать не фиксированное количество новостей, а автоматическую прокрутку по всей длинне блока.
</span></p>

</div>


<div style="padding: 15px;width: 245px; display: inline-block; ">

<img style="float: left; padding-right: 5px; padding-bottom: 5px;" src="http://idealnaya-svadba.com.ua/files/data/image/olga/8.jpg"><br>
<p align="justify"><span style="font-size: 12px; font-family: Tahoma; ">Предположительно здесь будет расположен текст определённой новости. В идеале планируется сделать не фиксированное количество новостей, а автоматическую прокрутку по всей длинне блока.
</span></p>

</div>

<div style="padding: 15px; width: 245px; display: inline-block; ">

<img style="float: left; padding-right: 5px; padding-bottom: 5px;" src="http://idealnaya-svadba.com.ua/files/data/image/olga/8.jpg"><br>
<p align="justify"><span style="font-size: 12px; font-family: Tahoma; ">Предположительно здесь будет расположен текст определённой новости. В идеале планируется сделать не фиксированное количество новостей, а автоматическую прокрутку по всей длинне блока.
</span></p>

</div>

<div style="padding: 15px;width: 245px; display: inline-block; ">

<img style="float: left; padding-right: 5px; padding-bottom: 5px;" src="http://idealnaya-svadba.com.ua/files/data/image/olga/8.jpg"><br>
<p align="justify"><span style="font-size: 12px; font-family: Tahoma; ">Предположительно здесь будет расположен текст определённой новости. В идеале планируется сделать не фиксированное количество новостей, а автоматическую прокрутку по всей длинне блока.
</span></p>

</div>

</section></aside>

</div></center>




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
<a href=""><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='assets/img/public/vks.png';" onmouseout="this.src='assets/img/public/vk.png';" src="assets/img/public/vk.png" width="30" height="30" alt=""></a>
<a href=""><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='assets/img/public/oks.png';" onmouseout="this.src='assets/img/public/ok.png';" src="assets/img/public/ok.png" width="30" height="30" alt=""></a>
<a href=""><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='assets/img/public/fs.png';" onmouseout="this.src='assets/img/public/f.png';" src="assets/img/public/f.png" width="30" height="30" alt=""></a>
<a href=""><img style="padding: 0px 15px 0px 0px;" onmouseover="this.src='assets/img/public/ts.png';" onmouseout="this.src='assets/img/public/t.png';" src="assets/img/public/t.png" width="30" height="30" alt=""></a>
</center>
      </div>

                               </div>






                                <div class="grid_2">
    <h3>НАШИ УСЛУГИ <span></span></h3>
    <div class="title-divider"><span>&nbsp;</span></div>
    <div class="custom-footer-content">
	<ul>



	    <li><a href="">Организация свадьбы</a></li>
	    <li><a href="">Подача заявления в ЗАГС</a></li>
	    <li><a href="">Коммерческий ЗАГС</a></li>
	    <li><a href="">Выездная регистрация брака</a></li>
	    <li><a href="">Выкуп</a></li>
	    <li><a href="">Выездное обслуживание</a></li>

	</ul>	
    </div>
</div>

<div class="grid_2">
    <h3> <span></span></h3>
<p style="padding-top:7px;"></p>
    <div class="title-divider1"><span>&nbsp;</span></div>
    <div class="custom-footer-content">
	<ul>

	    <li><a href="">Аренда транспорта</a></li>
	    <li><a href="">Постановка свадебного танца</a></li>
	    <li><a href="">Романтические сюрпризы</a></li>
	    <li><a href="">Платья и аксессуары</a></li>
	    <li><a href="">Мальчишник и девичник</a></li>
	    <li><a href="">Встреча из роддома</a></li>

	</ul>
    </div>
</div>


<div class="grid_2">
    <h3> <span></span></h3>
<p style="padding-top:7px;"></p>
    <div class="title-divider1"><span>&nbsp;</span></div>
    <div class="custom-footer-content">
	<ul>
	    <li><a href="">Ведущие</a></li>
	    <li><a href="">Свадебный образ</a></li>
	    <li><a href="">Фото и видеосъёмка</a></li>
	    <li><a href="">Шоу-программа</a></li>	    
		<li><a href="">Спецэффекты</a></li>
	    <li><a href="">Свадебное оформление</a></li>



	</ul>
    </div>
</div>

<div style="width:250px; padding-right:10px;" class="grid_3 alpha">
    <!--<div id="messages_product_view"></div> -->   
    <h3>ВОЗНИКЛИ ВОПРОСЫ?<span></span></h3>
    <div class="contacts-footer-content">
        <form action="" id="contactForm" method="post">
            <ul class="form-list">
                <li class="fields">
                    <div class="field">
                        <label for="name" class="required"><em>*</em>Ваше имя</label>
                        <div class="input-box">
                            <input name="name" id="name" placeholder="Ваше имя" title="Ваше имя" value class="input-text required-entry" type="text">
                        </div>
                    </div>
                    <div class="field">
                        <label for="email" class="required"><em>*</em>Email</label>
                        <div class="input-box">
                            <input name="email" id="email" placeholder="Email" title="Email" value class="input-text required-entry validate-email" type="text">
                        </div>
                    </div>
                </li>
                <li>
                    <label for="telephone">Контактный телефон</label>
                    <div class="input-box">
                        <input name="telephone" id="telephone" placeholder="Контактный телефон" title="Контактный телефон" value class="input-text" type="text">
                    </div>
                </li>
                <li class="wide">
                    <label for="comment" class="required"><em>*</em>Ваш вопрос</label>
                    <div class="input-box">
                        <textarea name="comment" id="comment" placeholder="Ваш вопрос" title="Ваш вопрос" class="required-entry input-text" cols="5" rows="3"></textarea>
                    </div>
                </li>
            </ul>           
            <div class="buttons-set">
                <p class="required">* Required Fields</p>
                <input type="text" name="hideit" id="hideit" value style="display:none !important;">
                <button type="submit" title="Отправить" class="button"><span><span>Отправить</span></span></button>
            </div>
        </form>
    </div>
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
<li><a href="">Социальная сеть</a></li>
<li><a href="">Главная</a></li>
<li><a href="">Наши услуги</a></li>
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
