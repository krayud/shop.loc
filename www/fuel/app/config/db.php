<?php
return array(
	'active' => 'development',

	'development' => array(
			'type'           => 'mysqli',
			'connection'     => array(
				'hostname'       => 'localhost',
				'port'           => '3306',
				'database'       => 'wedding_db',
				'username'       => 'dbuser',
				'password'       => '5A7wAGeywLXuqbpe',
				'persistent'     => false,
			),
			'table_prefix'   => '',
			'charset'        => 'utf8',
			'enable_cache'   => true,
			'profiling'      => false,
		),

);
