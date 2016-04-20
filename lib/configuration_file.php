<?php
	class ConfigurationFile extends ArrayFile{
		function __construct($file, $default_board = ""){
			parent::__construct($file, array("last_board" => $default_board, "last_board_off" => $default_board));
		}
		
		public function getConfiguration($value){
	 		return parent::getValue($value);
	 	}
	 	public function setConfiguration($configuration, $value){
	 		parent::setValue($configuration, $value);
	 	}
	}


?>