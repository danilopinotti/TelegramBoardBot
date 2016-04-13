<?php
	include "configs/application.php";
	include "BoardBot.php";

	$bot = new BoardBot($telegramBotConfig["token"], 
						$telegramBotConfig["bot_name"], 
						$telegramBotConfig["valid_boards"], 
						$telegramBotConfig["models_folder"], 
						$telegramBotConfig["config_file"]);
	$bot->setWhiteList($telegramBotConfig["white_list"]);
	$bot->loadBoard();
?>

<! DOCTYPE html>
<html>
	<head>
		<title>Board BOT</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?= ASSETS_FOLDER ?>/css/application.css">
	</head>
	<body>

		<?php include($bot->getBoard()); ?>

		<script src="<?= ASSETS_FOLDER ?>/js/jquery-1.12.3.min.js"></script>
		<script src="<?= ASSETS_FOLDER ?>/js/application.js"></script>
	</body>
</html>
