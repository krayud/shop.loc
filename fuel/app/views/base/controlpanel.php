<!DOCTYPE html>
<html>
<head>
	<title><?=$pageTitle;?></title>
	<?require_once("helpers/cssjsattach.php");?>
</head>
<body>
	<div class="container">
	
		<div class="row">
		  <div class="span12" id="head">
				<a href="<?=Uri::base(false)."cp/";?>"><div id="logo"></div></a>
				<div id="head-block">
					  <a href="<?=Uri::Base(false)?>">Сайт</a>
					  <a href="#">Ссылка</a>
					  <a href="#">Ссылка</a>
					  <a href="#">Ссылка</a>
				</div>
				<div class="clear"></div>
		  </div>
		</div>
		
		<div class="row">
		  <div class="span3" id="sitebar">
		  	<ul class="nav nav-list">
		  		<?
					foreach($barModules as $module)
						echo $module;
				?>
			</ul>	
		  </div>
			<div class="span9" id="content">
				<div style="padding:20px;">
				   <? echo $pageContent;?>
				</div>
			</div>
		</div>
		
		<div class="row">
		  <div class="span12" id="footer"><small>LDcms - панель управления</small></div>
		</div>
		
	</div>

</body>
</html>