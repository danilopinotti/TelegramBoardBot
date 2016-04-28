<?php
	$telegram_bot = new TelegramBot($telegramBotConfig["token"], $telegramBotConfig["bot_name"]);
	$telegram_bot->setWhiteList($telegramBotConfig["white_list"]);

	$bot = new BoardBot($telegram_bot,
						$telegramBotConfig["valid_boards"], 
						$telegramBotConfig["boards_folder"], 
						$telegramBotConfig["config_file"]);

	$bot->loadBoard();
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?= APP_NAME ?></title>
		<meta charset="UTF-8">
		<?= ViewHelpers::stylesheetIncludeTag("application.css"); ?>
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
		<?= ViewHelpers::javascriptIncludeTag("jquery-1.12.3.min.js", "ajax_board.js"); ?>
	</body>
</html>
