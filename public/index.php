<?php

// Notre propre configuration
define('MB_ENCODING', 'UTF-8');

// Save the project root directory as a global constant.
define('ROOT_PATH', __DIR__ . '/..');

/**
 * Configuration du cookie de session
 * /!\ FIXME à changer chez vous
 */
session_set_cookie_params(86400, '/dev/resto');

// Augmentation du temps de session côté serveur (24h)
ini_set('session.gc_maxlifetime', 86400);

// Changement du nom du cookie de session
ini_set('session.name', 'session_resto_3wa');

// Changement de l'emplacement de stockage des fichiers de session
ini_set('session.save_path', ROOT_PATH . '/application/var/sessions');

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