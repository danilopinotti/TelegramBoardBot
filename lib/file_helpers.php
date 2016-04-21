<?php
	class FileHelpers{

		/* 
		 * Retorna uma array com os arquivos de um diretório.
		 * Caso seja passado o segundo parâmetro como true, é retornado sem extensão
		 */
		public static function filesInDirectory($directory, $without_extension = false){
		  $files_raw = array_slice(scandir($directory), 2);
		  $files = [];
		  if ($without_extension == true){
		    foreach ($files_raw as $file) {
		      $files[] = preg_replace('/\\.[^.\\s]{3,5}$/', '', $file);
		    }
		    return $files;
		  }
		  else
		    return $files_raw;
		}


		/*
		 * Retorna a array que estava dentro de um arquivo.
		 * A array deve ser serializada para o método funcionar normalmente.
		 */
		public static function fileToArray($file){
		    $values = array();
		    if(file_exists($file)){
		      $values = unserialize(file_get_contents($file));
		  	}
		    return $values;
		}

		/*
		 * Retorna uma array com todos os comandos customizados para telegram.
		 */
		public static function getTelegramCommands($file){
			$telegram_commands = FileHelpers::fileToArray($file);
			$commands = array();
			if($telegram_commands != null){
				foreach($telegram_commands as $command => $board){
			        if (substr($command, 0, 1) == '/')
			          $commands[$command] = $board;
			        else
			          $commands["/".$command] = $board;
			    }
			}
			return $commands;
		}

		/*
		 * Armazena uma array de forma serializada em um arquivo.
		 */
		public static function arrayToFile($array, $file){
			if(file_put_contents($file, serialize($array)))
				return 1;
			else
				return 0;
		}

	}
?>