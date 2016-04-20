<?php
	$bot = new BoardBot($telegramBotConfig["token"], 
						$telegramBotConfig["bot_name"], 
						$telegramBotConfig["valid_boards"], 
						$telegramBotConfig["boards_folder"], 
						$telegramBotConfig["config_file"]);
	$bot->setWhiteList($telegramBotConfig["white_list"]);
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
		<?= ViewHelpers::javascriptIncludeTag("jquery-1.12.3.min.js", "application.js"); ?>
	</body>
</html>
