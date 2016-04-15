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

<!DOCTYPE html>
<html>
	<head>
		<title>Board BOT</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="<?= ASSETS_FOLDER ?>/css/application.css">
		<!-- <meta http-equiv="refresh" content="120" > -->
		<style>
			@import url("<?= ASSETS_FOLDER ?>/fonts/OpenSans-ExtraBold.ttf");
		</style>
	</head>
	<body>
		<span class="bar black"></span>
		<span class="bar yellow"></span>
		<div class="message-container">
			<?php include($bot->getBoard()); ?>
		</div>

		<script src="<?= ASSETS_FOLDER ?>/js/jquery-1.12.3.min.js"></script>
		<script src="<?= ASSETS_FOLDER ?>/js/application.js"></script>
	</body>
</html>
