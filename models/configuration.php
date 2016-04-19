<?php
	class Configuration{
		private $file;
		private $configs;
		function __construct($file){
			if(!file_exists($file)){
				$configs = array();
				$configs["last_board"] = "aberto";
				$configs["last_board_off"] = "aberto";
				file_put_contents($file, serialize($configs));
			}
			$this->file = $file;
			$this->configs = [];
			$this->configs = unserialize(file_get_contents($this->file));
		}
	 	public function getConfiguration($configuration){
	 		return $this->configs[$configuration];
	 	}
	 	public function setConfiguration($configuration, $value){
	 		$this->configs[$configuration] = $value;
	 		file_put_contents($this->file, serialize($this->configs));
	 	}
	}
?>