<?php
	function __autoload($class_name) {
		$class_name = preg_replace('/([a-z])([A-Z])/', '$1_$2', $class_name);
		
		$class_name = strtolower($class_name);


	    $paths = [];
	    $paths[] = APP_ROOT_FOLDER . "/models/" . $class_name . ".php";
	    $paths[] = APP_ROOT_FOLDER . "/lib/" . $class_name . ".php";

	    foreach ($paths as $path) {
	    	if (file_exists($path)) {
			    return require_once($path);
			}
	    }
	    return false;
	    
	}
?>