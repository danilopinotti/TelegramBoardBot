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
		<?= ViewHelpers::stylesheetIncludeTag("bootstrap.min.css", "bootstrap-theme.min.css", "application.css", "sticky-footer-navbar.css"); ?>
		<!-- <meta http-equiv="refresh" content="120" > -->
	</head>
	<body>
		<!-- 
		<span class="bar black"></span>
		<span class="bar yellow"></span> 
		-->
		<div class="container">
				<div class="message text-center">
					<?php include($bot->getBoard()); ?>
				</div>
		</div>
		<footer class="footer">
		    <div class="container">
		      <p class="text-muted">COGETI - GP</p>
		    </div>
		</footer>
		<?= ViewHelpers::javascriptIncludeTag("jquery-1.12.3.min.js", "ajax_board.js", "bootstrap.min.js"); ?>
	</body>
</html>
