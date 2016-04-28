<?php
	class BoardBot{
		private $telegram_bot;
		private $valid_boards;
		private $configs;
		private $boards_folder;

		function __construct($telegram_bot, $valid_boards, $boards_folder = "./boards/", $config_file = "./.config"){
			$this->configs = new ConfigurationFile($config_file, "aberto");
			$this->telegram_bot = $telegram_bot;

			$this->valid_boards = $valid_boards;
			$this->setModelsFolder($boards_folder);
		}



		//Verify if atual status from board is equivalent to telegram chat and load if not
		public function loadBoard(){			
			//Update with offline command
			if($this->configs->getConfiguration("last_board_off") != $this->configs->getConfiguration("last_board")){
				$this->configs->setConfiguration("last_board", $this->configs->getConfiguration("last_board_off"));
				//Offline configuration have priority.
				return;
			}

			//Invalid token or without Internet connection
			$this->telegram_bot->update();
			if(!$this->telegram_bot->getUpdates()){
				echo "Sem conexão com a internet ou token inválido.";
				return;
			}

			$last_message = $this->telegram_bot->getLastMessage();
			if(!empty($last_message)){

 				$match = "/".$this->telegram_bot->getBotName()."/";
				$text = preg_replace($match, "", $last_message["text"]);		

				if(substr($text,0,1) == "/"){
					$board_name = $this->getModelName($last_message["text"]);
					if($board_name){
						$this->configs->setConfiguration("last_board",$board_name);
						$this->configs->setConfiguration("last_board_off",$board_name);
						$this->telegram_bot->sendMessage("Status alterado", $last_message["chat_id"], $last_message["message_id"]);
					}
				}
			}

		}

		//Return the name of board model from telegram command.
		private function getModelName($key){
			return $this->valid_boards[$key];
		}

		//Return the board file reference.
		public function getBoard(){
			return $this->boards_folder.$this->configs->getConfiguration("last_board").".phtml";
		}


		public function setModelsFolder($boards_folder){
			if(substr($boards_folder, -1) != "/")
				$this->boards_folder = $boards_folder."/";
			else
				$this->boards_folder = $boards_folder;	
		}



		//This function return if have or not updates
		public static function haveUpdates($token, $config_file){
			$configs = new ConfigurationFile($config_file);
			if ($configs->getConfiguration("last_board_off") != $configs->getConfiguration("last_board")){
				return "true";
			}

			return TelegramBot::haveUpdates($token);
		}
	}
?>