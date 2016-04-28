<?php
	class TelegramBot{
		private $token;
		private $bot_name;
		private $whitelist;
		private $updates;

		function __construct($token, $bot_name = "", $whitelist = array()){
			$this->token = $token;
			$this->bot_name = $bot_name;
			$this->whitelist = $whitelist;
		}

		//Method to send message to telegram
		public function sendMessage($message, $chat = "", $message_id = ""){
			$complement = "";

			if($message_id != "" && $chat < 0)
			 	$complement .= "&reply_to_message_id=".$message_id;

			file_get_contents('https://api.telegram.org/bot'.$this->token.'/sendMessage?chat_id='.$chat.'&text='.urlencode($message).$complement,false);
		}

		//Verify if user have permission to use this bot
		public function isWhiteListed($chat_id, $username){
			if (!empty($this->white_list)){
				foreach ($this->white_list as $chat_whitelisted)
					if ($chat_whitelisted == $chat_id || $chat_whitelisted == $username)
						return true;
				return false;
			}
			else
				return true;
		}

		public static function haveUpdates($token){
			$updates = @json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getUpdates", true));

			if(@sizeof($updates->result))
				return true;
			else
				return false;
		}


		public function setWhiteList($white_list){
			$this->white_list = $white_list;
		}

		public function update(){
			$this->updates = @json_decode(file_get_contents("https://api.telegram.org/bot".$this->token."/getUpdates", true));
		}


		public function getUpdates(){
			return $this->updates;
		}


		public function getLastMessage(){
			$last_result_id = sizeof($this->updates->result);
			if($last_result_id){
			
				$text = $this->updates->result[$last_result_id-1]->message->text;
				$chat_id = $this->updates->result[$last_result_id-1]->message->chat->id;
				$from_id = $this->updates->result[$last_result_id-1]->message->from->id;
				$last_offset = $this->updates->result[$last_result_id-1]->update_id;
				$message_id = $this->updates->result[$last_result_id-1]->message->message_id;
				$username = $this->updates->result[$last_result_id-1]->message->from->username;

				@file_get_contents("https://api.telegram.org/bot".$this->token."/getUpdates?offset=".($last_offset + 1), true);
			
				if(!$this->isWhiteListed($from_id, $username)){
					$this->sendMessage("Você não tem permissão para interagir com este BOT.", $chat_id, $message_id);
					return;
				}
				
				return array("text" => $text,
							"chat_id" => $chat_id,
							"from_id" => $from_id,
							"last_offset" => $last_offset,
							"message_id" => $message_id,
							"username" => $username);
		}
		else
			return array();
	}

		public function getBotName(){
			return $this->bot_name;
		}

	}
?>