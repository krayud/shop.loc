<?php

$publicFolder = "public/";
$controlPanelFolder = "cp/";
return array(
	'_root_'  => $publicFolder.'static/page/index/',  // публичные страницы по-дефолту
	'cp'  => $controlPanelFolder.'index/index', // Cp по-дефолту
	'_404_'   => 'welcome/404',    // The main 404 route
	'page/(:any)'      => $publicFolder.'static/page/$1',//перенапрявляет запросы на "статические" страницы через public/static/page/
	'cp/(:any)'      => $controlPanelFolder.'$1',//перенапрявляет все запросы начинающиеся с "cp/" через папку cp
	'(:any)'      => $publicFolder.'$1',//ДОЛЖНА БЫТЬ В САМОМ КОНЦЕ!!! перенапрявляет все запросы через папку public
);