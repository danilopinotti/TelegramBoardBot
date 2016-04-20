<?php
	class BoardBot{
		private $token;
		private $bot_name;
		private $valid_boards;
		private $white_list;
		private $configs;
		private $boards_folder;

		function __construct($token, $bot_name, $valid_boards, $boards_folder = "./boards/", $config_file = "./.config"){
			$this->configs = new ConfigurationFile($config_file, "aberto");
			$this->token = $token;
			$this->bot_name = $bot_name;
			$this->valid_boards = $valid_boards;
			$this->setModelsFolder($boards_folder);
		}

		//Method to send message to telegram
		private function sendMessage($message, $chat = "", $message_id = ""){
			$complement = "";

			if($message_id != "" && $chat < 0)
			 	$complement .= "&reply_to_message_id=".$message_id;

			file_get_contents('https://api.telegram.org/bot'.$this->token.'/sendMessage?chat_id='.$chat.'&text='.urlencode($message).$complement,false);
		}

		//Verify if user have permission to use this bot
		private function isWhiteListed($chat_id, $username){
			if (!empty($this->white_list)){
				foreach ($this->white_list as $chat_whitelisted)
					if ($chat_whitelisted == $chat_id || $chat_whitelisted == $username)
						return true;
				return false;
			}
			else
				return true;
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
			$updates = json_decode(@file_get_contents("https://api.telegram.org/bot".$this->token."/getUpdates", true));
			if(!$updates){
				echo "Sem conexão com a internet.";
				return;
			}

			//Update with telegram command
			$last_result_id = sizeof($updates->result);
			if($last_result_id){
			
				$text = $updates->result[$last_result_id-1]->message->text;
				$chat_id = $updates->result[$last_result_id-1]->message->chat->id;
				$from_id = $updates->result[$last_result_id-1]->message->from->id;
				$last_offset = $updates->result[$last_result_id-1]->update_id;
				$message_id = $updates->result[$last_result_id-1]->message->message_id;
				$username = $updates->result[$last_result_id-1]->message->from->username;

				@file_get_contents("https://api.telegram.org/bot".$this->token."/getUpdates?offset=".($last_offset + 1), true);
			
				if(!$this->isWhiteListed($from_id, $username)){
					$this->sendMessage("Você não tem permissão para interagir com este BOT.", $chat_id, $message_id);
					return;
				}
					
				$match = "/".$this->bot_name."/";
				$text = preg_replace($match, "", $text);		

				if(substr($text,0,1) == "/"){
					$board_name = $this->getModelName($text);
					if($board_name){
						$this->configs->setConfiguration("last_board",$board_name);
						$this->configs->setConfiguration("last_board_off",$board_name);
						$this->sendMessage("Status alterado", $chat_id, $message_id);
					}
				}
				else
					$this->sendMessage("Ocorreu um erro interno", $chat_id, $message_id);
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

		public function setWhiteList($white_list){
			$this->white_list = $white_list;
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

			$updates = @json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getUpdates", true));

			if(@sizeof($updates->result))
				return "true";
			else
				return "false";
		}
	}
?>