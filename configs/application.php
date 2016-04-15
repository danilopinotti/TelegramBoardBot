<?php
	define("SITE_ROOT", "/github");
	define("APP_ROOT_FOLDER", $_SERVER['DOCUMENT_ROOT'] . "/" . SITE_ROOT . "/");
	define("ASSETS_FOLDER", SITE_ROOT."/assets");

	set_include_path(get_include_path() . PATH_SEPARATOR .  APP_ROOT_FOLDER);
	set_include_path(get_include_path() . PATH_SEPARATOR .  APP_ROOT_FOLDER . "models");

	require "bot_configs.php";
?>
