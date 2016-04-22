<?php
	$telegramBotConfig = array();

	//Telegram command associated by board name.
	$telegramBotConfig["valid_boards"] = array(	// Message from TELEGRAM CHAT => board name
	    "/reuniao" => "reuniao",
	    "/aberto" => "aberto",
	    "/manutencao_datacenter" => "manutencao_datacenter",
	    "/atendimento_externo" => "atendimento_externo"
	);

	//List of allowed users.
	$telegramBotConfig["white_list"] = array(	//Allowed persons (ID or Username) to interact with BOT
		"DaniloPinotti",	//Danilo
		"144880123"
	);

	//Specific bot settings
	$telegramBotConfig["token"] = "1111111:IAOAIUHPKASIJDOAJSDP";
	$telegramBotConfig["bot_name"] = "@PinottiBoardBot";

	//General configurations
	$telegramBotConfig["boards_folder"] = APP_ROOT_FOLDER."/boards";
	$telegramBotConfig["config_file"] = APP_ROOT_FOLDER."/.config";
	
	//Load created boards from offline panel.
	array_merge($telegramBotConfig["valid_boards"], FileHelpers::getTelegramCommands(SITE_ROOT."/db/telegram_commands"));
?>
