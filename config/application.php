<?php
	define('APP_NAME', 'BoardBot');
	define('SITE_ROOT', '/board-bot');
	define('APP_ROOT_FOLDER', $_SERVER['DOCUMENT_ROOT'] . '/' . SITE_ROOT);
	define('ASSETS_FOLDER', SITE_ROOT.'/assets');

	set_include_path(get_include_path() . PATH_SEPARATOR .  APP_ROOT_FOLDER);
	set_include_path(get_include_path() . PATH_SEPARATOR .  APP_ROOT_FOLDER . '/models');

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	require_once 'config/autoload_class.php';

	$autoload = new AutoloadClass();
	$autoload->addPath('/models/');
	$autoload->addPath('/lib/');

	require 'bot_configs.php';

	$access_pwd = 'cogeti-gp';
?>
