<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<title><?=$pageTitle;?></title>
<?require_once("helpers/cssjsattach.php");?>

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic" />
<link rel="shortcut icon" href="<?=Uri::base(false)?>assets/img/cp/template/favicon.ico" />
<body>
<div id="page-container">
<header class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-inner remove-radius remove-box-shadow">
<div class="container-fluid">
<ul class="nav pull-right visible-phone visible-tablet">
<li class="divider-vertical remove-margin"></li>
<li>
<a href="javascript:void(0)" data-toggle="collapse" data-target=".nav-collapse">
<i class="icon-reorder"></i>
</a>
</li>
</ul>
<a href="<?=Uri::base(false)?>cp" class="brand"><img src="<?=Uri::base(false)?>assets/img/cp/template/logo.png" alt="logo" /></a>
<div id="loading" class="hide pull-left"><i class="icon-certificate icon-spin"></i></div>
<ul id="widgets" class="nav pull-right">


	<li class="dropdown dropdown-user">
		<a href="<?=Uri::base(false)?>"><small>Открыть сайт</small></a>

	</li>


<li class="divider-vertical remove-margin"></li>
	<li class="dropdown dropdown-user">
		<a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><small>Панель управления</small><b class="caret"></b></a>
			<ul class="dropdown-menu">
			<li>
			<a href="javascript:void(0)" class="loading-on"><i class="icon-refresh"></i> <small>Обновить</small></a>
			</li>
			<li class="divider"></li>
			<li>
			<a href="javascript:void(0)"><i class="icon-off"></i> <small>Выход</small></a>
			</li>
		</ul>
	</li>
</ul>
</div>
</div>
</header>
<div id="inner-container">
<aside id="page-sidebar" >

<nav id="primary-nav">
<ul class="visible-desktop affix" style="width: 200px;">
<li>
<a href="" class="active"><i class="icon-link"></i>Панель управления</a>
</li>
<? 
	foreach($barModules as $moduleBar)
		print($moduleBar);
	?>

<li>
<a href=""><i class="icon-move"></i>Расширения</a>
<ul>
<li>
<a href="#"><i class="icon-thumbs-up"></i>Голосования</a>
</li>
<li>
<a href="#"><i class="icon-envelope"></i>Подписка</a>
</li>
</ul>
</li>

<li>
<a href="#"><i class="icon-cog"></i>Настройки</a>
</li>
</ul>
</nav>



</aside>
<div id="page-content" class='margin-top:40px;'>
	<ul id="nav-info" class="clearfix">
		<li><a href="<?=Uri::base(false);?>cp"><i class="icon-home"></i></a></li>
		<li><a href="">Ссылка</a></li>
	</ul>
	<div style="padding:20px;">
	   <? echo $pageContent;?>
	</div>
</div>
<footer>
<small><strong>DIMENSION CMS</strong>™</small>
</footer>
</div>
</div>
<a href="#" id="to-top"><i class="icon-chevron-up"></i></a>

<script type="text/javascript" src="<?=Uri::base(false);?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=Uri::base(false);?>assets/js/cp/template/plugins.js"></script>
<script type="text/javascript" src="<?=Uri::base(false);?>assets/js/cp/template/main.js"></script>


</body>
</html>