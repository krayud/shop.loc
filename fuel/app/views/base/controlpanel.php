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
				<div id="logo"></div>
				<div id="head-block">
					  <a href="<?=Uri::Base(false)?>">На сайт</a>
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
			  <li class="nav-header">List header</li>
			  <li><a href="#">Home</a></li>
			   <li class="divider"></li>
			  <li class="nav-header">List header</li>
			  <li><a href="#">Home</a></li>
			</ul>
			
		  </div>
			<div class="span9" id="content">
				<div class="alert alert-success">
				  <button type="button" class="close" data-dismiss="alert">×</button>
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