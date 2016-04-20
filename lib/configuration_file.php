<?php
	class ConfigurationFile extends ArrayFile{
		function __construct($file){
			parent::__construct($file, array("last_board" => "aberto", "last_board_off" => "aberto"));
		}
		
		public function getConfiguration($value){
	 		return parent::getValue($value);
	 	}
	 	public function setConfiguration($configuration, $value){
	 		parent::setValue($configuration, $value);
	 	}
	}


?>