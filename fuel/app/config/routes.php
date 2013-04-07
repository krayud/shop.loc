<?php
return array(
	'_root_'  => 'public/index/index',  // The default route
	'cp'  => 'cp/index/index', 
	'_404_'   => 'welcome/404',    // The main 404 route
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);