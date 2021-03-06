<?php

/*
 * Routes configuration settings.
 */

/*
 * Associative array of route arrays as route names for indexes
 * with route path and controller as route array indexes
 */
$config['routes'] = [
	'homepage' => ['path' => '', 'controller' => 'Home'],
	'user_create' => ['path' => '/user/create', 'controller' => 'UserCreate'],
	'user_login' => ['path' => '/login', 'controller' => 'UserLogin'],
	'user_logout' => ['path' => '/logout', 'controller' => 'UserLogout'],
];