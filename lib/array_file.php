<?php
	class ArrayFile{
		protected $file;
		protected $rows;
		function __construct($file, $initial_values = array() ){
			if(!file_exists($file)){
				$rows = $initial_values;
				FileHelpers::arrayToFile($rows, $file);
			}
			$this->file = $file;
			$this->rows = [];
			$this->rows = FileHelpers::fileToArray($file);
		}
	 	public function getValue($value){
	 		return $this->rows[$value];
	 	}
	 	public function setValue($key, $value){
	 		$this->rows[$key] = $value;
	 		FileHelpers::arrayToFile($this->rows, $this->file);
	 	}
	}

?>