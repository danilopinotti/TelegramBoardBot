<?php
	$telegramBotConfig = [];

	$telegramBotConfig["valid_boards"] = array( // Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "default"
	);

	$telegramBotConfig["white_list"] = array(	//Allowed persons (ID or Username) to interact with BOT
		"DaniloPinotti",	//Danilo
		"144880123"
	);

	$telegramBotConfig["token"] = "166840928:AAAAAAAAAAAAAAAAAAAAAAAAAAAA";
	$telegramBotConfig["bot_name"] = "@PinottiTestBot";
	$telegramBotConfig["models_folder"] = "./boards";
	$telegramBotConfig["config_file"] = "./config.php";
?>