<!DOCTYPE html>
<html>
<head>
	<? require_once("helpers/cssjsattach.php"); ?>
	<title><? if(isset($pageTitle)) echo $pageTitle;?></title>
</head>
<body>
<div id="wrapper">
	<div id="head">head</div>
	<div id="center">
		<div id="content">
			<? if(isset($pageContent)) echo $pageContent?>
		</div><!--/content-->
		<div id="sitebar">e natus error sit voluptatem accusantium doloremque laudantium, 
			totam rem aperiam, eaque ipsa quae auo quisquam est, qui dolorem ipsum quia 
			dolor sit amet, consectetur, adipisci velit, sed quia non
		</div><!--/sitebar-->
		<div class="clear"></div>
	</div><!--/center-->
	<div id="footer">sed do eiusmod tempor incididunt ut labore et dolore 
		magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
		laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in 
		reprehenderit in voluptate velit esse 
		cillum dolore eu fugiat nulla pariatur. Excepteur sint
	</div><!--/footer-->
<div><!--/wrapper-->
</body>
</html>