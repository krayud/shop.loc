<?php

$publicFolder = "/";
$controlPanelFolder = "cp/";
return array(
	'_root_'  => $publicFolder.'static/page/index/',  // публичные страницы по-дефолту
	'cp'  => $controlPanelFolder.'index/index', // Cp по-дефолту
	'_404_'   => 'welcome/404',    // The main 404 route
	'page/(:any)'      => $publicFolder.'static/page/$1',//перенапрявляет запросы на "статические" страницы через /static/page/
	
);