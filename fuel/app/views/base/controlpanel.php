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
		<a href="#"><small>Открыть сайт</small></a>

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
<div id="inner-container"><aside id="page-sidebar" class="nav-collapse collapse">
<div style="padding-top:11px;"></div>
<nav id="primary-nav" class='affix' style="width:200px;">
<ul>
<li>
<a href="" class="active"><i class="icon-link"></i>Панель управления</a>
</li>
<li>
<a href=""><i class="icon-file"></i>Страницы</a>
<ul>
<li>
<a href="<?=Uri::base(false);?>cp/page/new"><i class="icon-pencil"></i>Добавить страницу</a>
</li>
<li>
<a href="<?=Uri::base(false);?>cp/page/list"><i class="icon-th"></i>Обзор всех страниц</a>
</li>
</ul>
</li>
<li>
<a href=""><i class="icon-edit"></i>Блог</a>
<ul>
<li>
<a href="<?=Uri::base(false);?>cp/blog/new"><i class="icon-pencil"></i>Добавить запись</a>
</li>
<li>
<a href=""><i class="icon-align-justify"></i>Категории</a>
</li>
<li>
<a href=""><i class="icon-th"></i>Обзор всех записей</a>
</li>
</ul>
</li>

<li>
<a href=""><i class="icon-shopping-cart"></i>Интернет-магазин</a>
<ul>
<li>
<a href=""><i class="icon-pencil"></i>Добавить товар</a>
</li>
<li>
<a href=""><i class="icon-align-justify"></i>Категории</a>
</li>
<li>
<a href=""><i class="icon-th"></i>Обзор всех товаров</a>
</li>
</ul>
</li>

<li>
<a href=""><i class="icon-thumbs-up"></i>Социальная сеть</a>
<ul>
<li>
<a href=""><i class="icon-user"></i>Пользователи</a>
</li>
<li>
<a href=""><i class="icon-user"></i>Группы</a>
</li>
</ul>
</li>

<li>
<a href=""><i class="icon-move"></i>Расширения</a>
<ul>
<li>
<a href=""><i class="icon-thumbs-up"></i>Голосования</a>
</li>
<li>
<a href=""><i class="icon-envelope"></i>Подписка</a>
</li>
</ul>
</li>

<li>
<a href=""><i class="icon-cog"></i>Настройки</a>
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
<div id="modal-user-settings" class="modal hide">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4>Profile Settings</h4>
</div>
<div class="modal-body">
<ul id="example-user-tabs" class="nav nav-tabs">
<li class="active"><a href="#example-user-tabs-account"><i class="icon-cogs"></i> Account</a></li>
<li><a href="#example-user-tabs-profile"><i class="icon-user"></i> Profile</a></li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="example-user-tabs-account">
<div class="alert alert-success">
<button type="button" class="close" data-dismiss="alert">&times;</button>
<strong>Success!</strong> Password changed!
</div>
<form class="form-horizontal" />
<div class="control-group">
<label class="control-label" for="example-user-username">Username</label>
<div class="controls">
<input type="text" id="example-user-username" class="disabled" value="administrator" disabled="" />
<span class="help-block">You can't change your username!</span>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-pass">Password</label>
<div class="controls">
<input type="password" id="example-user-pass" />
<span class="help-block">if you want to change your password enter your current for confirmation!</span>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-newpass">New Password</label>
<div class="controls">
<input type="password" id="example-user-newpass" />
</div>
</div>
</form>
</div>
<div class="tab-pane" id="example-user-tabs-profile">
<h5 class="page-header-sub hidden-phone">Image</h5>
<div class="form-horizontal hidden-phone">
<div class="control-group">
<img src="img/placeholders/image_dark_120x120.png" alt="image" />
</div>
<div class="control-group">
<form action="index.php" class="dropzone" />
<div class="fallback">
<input name="file" type="file" />
</div>
</form>
</div>
</div>
<form class="form-horizontal" />
<h5 class="page-header-sub">Details</h5>
<div class="control-group">
<label class="control-label" for="example-user-firstname">Firstname</label>
<div class="controls">
<input type="text" id="example-user-firstname" value="John" />
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-lastname">Lastname</label>
<div class="controls">
<input type="text" id="example-user-lastname" value="Doe" />
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-gender">Gender</label>
<div class="controls">
<select id="example-user-gender">
<option />Male
<option />Female
</select>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-birthdate">Birthdate</label>
<div class="controls">
<div class="input-append">
<input type="text" id="example-user-birthdate" class="input-small input-datepicker" />
<span class="add-on"><i class="icon-calendar"></i></span>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-skills">Skills</label>
<div class="controls">
<select id="example-user-skills" multiple="multiple" class="select-chosen">
<option selected="" />html
<option selected="" />css
<option />javascript
<option />php
<option />mysql
</select>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-bio">Bio</label>
<div class="controls">
<textarea id="example-user-bio" class="textarea-elastic" rows="3">Bio Information..</textarea>
</div>
</div>
<h5 class="page-header-sub">Social</h5>
<div class="control-group">
<label class="control-label" for="example-user-fb">Facebook</label>
<div class="controls">
<div class="input-append">
<input type="text" id="example-user-fb" />
<span class="add-on"><i class="icon-facebook"></i></span>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-twitter">Twitter</label>
<div class="controls">
<div class="input-append">
<input type="text" id="example-user-twitter" />
<span class="add-on"><i class="icon-twitter"></i></span>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-pinterest">Pinterest</label>
<div class="controls">
<div class="input-append">
<input type="text" id="example-user-pinterest" />
<span class="add-on"><i class="icon-pinterest"></i></span>
</div>
</div>
</div>
<div class="control-group">
<label class="control-label" for="example-user-github">Github</label>
<div class="controls">
<div class="input-append">
<input type="text" id="example-user-github" />
<span class="add-on"><i class="icon-github"></i></span>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>


<script type="text/javascript" src="<?=Uri::base(false);?>assets/js/bootstrap.js"></script>
<script type="text/javascript" src="<?=Uri::base(false);?>assets/js/cp/template/plugins.js"></script>
<script type="text/javascript" src="<?=Uri::base(false);?>assets/js/cp/template/main.js"></script>


</body>
</html>