<?php

define('MB_ENCODING', 'UTF-8');

// Save the project root directory as a global constant.
define('ROOT_PATH', __DIR__ . '/..');

/*
 * Create a global constant used to get the filesystem path to the
 * application configuration directory.
 */
define('CFG_PATH', realpath(ROOT_PATH . '/application/config'));

/*
 * Create a global constant used to get the filesystem path to the
 * application public web root directory.
 *
 * Can be used to handle file uploads for example.
 */
define('WWW_PATH', realpath(ROOT_PATH . '/public'));

// Loading framework
require_once ROOT_PATH . '/library/framework.php';

$microKernel = new MicroKernel();
$microKernel->bootstrap()->run(new FrontController());