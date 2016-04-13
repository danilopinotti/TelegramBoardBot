<?php
	$telegramBotConfig = [];

	$telegramBotConfig["valid_boards"] = array( // Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "default"
	);

	$telegramBotConfig["white_list"] = array(	//Allowed persons (ID or Username) to interact with BOT
		"DaniloPinotti",	//Danilo
		"144880123"	//Mauricio
	);

	$telegramBotConfig["token"] = "123456:YTF6RTDSF6DAF6DTAS7676G67f76F76G76f";
	$telegramBotConfig["bot_name"] = "@PinottiTestBot";
	$telegramBotConfig["models_folder"] = "./boards";
	$telegramBotConfig["config_file"] = "./config.php";
?>