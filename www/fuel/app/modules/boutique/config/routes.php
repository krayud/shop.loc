<?php
return array(
	'_root_'  => 'boutique/all/index',
	'boutique/goods/(:any)'      => 'boutique/goods/id/$1', // Routes /blog/entry_name to /blog/entry/entry_name
	'boutique/cat/(:any)'      => 'boutique/cat/id/$1', // Routes /blog/entry_name to /blog/entry/entry_name
);