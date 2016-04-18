<?php
	$telegramBotConfig = [];

	$telegramBotConfig["valid_boards"] = array( // Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "aberto",
	    "/manutencao_datacenter" => "manutencao_datacenter",
	    "/atendimento_externo" => "atendimento_externo"
);

	$telegramBotConfig["white_list"] = array(	//Allowed persons (ID or Username) to interact with BOT
		"DaniloPinotti",	//Danilo
		"144880123"
	);

	$telegramBotConfig["token"] = "1111111:IAOAIUHPKASIJDOAJSDP";
	$telegramBotConfig["bot_name"] = "@PinottiBoardBot";
	$telegramBotConfig["boards_folder"] = "./boards";
	$telegramBotConfig["config_file"] = "./.config";
?>
