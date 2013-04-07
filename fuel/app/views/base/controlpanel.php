<!DOCTYPE html>
<html>
<head>
	<title><?=$pageTitle;?></title>
	<? 
		require_once("helpers/cssjsattach.php"); 
	?>
</head>
<body>
<body>
	<div id="head">
	Панель управления!!!!
	</div>
	
	<div id="middle">
		<div id="bar">
			Меню кабинета
		</div>
		<div id="center">
			<? echo $pageContent;?>
		</div>
	</div>
	<div class="clear"></div>
	
	<div id="footer">
	Футер
	</div>
</body>
</html>
