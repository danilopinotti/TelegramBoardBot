<?php
	include "configs/application.php";
	include "BoardBot.php";

	if(isset($_POST['board'])){
		$configs = new Configuration($telegramBotConfig["config_file"]);
		$configs->setConfiguration("last_board_off", $_POST['board']);
		echo "Status alterado para \"".$_POST['board']."\"";
	}

	$boards_raw = array_slice(scandir($telegramBotConfig["boards_folder"]), 2);
	$boards = [];
	foreach ($boards_raw as $board) {
		$boards[] = preg_replace('/\\.[^.\\s]{3,5}$/', '', $board);
	}


?>
<!DOCTYPE html>
<html>
	<head>
		 <title>BoardBot: Painel Offline</title>
	</head>
	<body>
		<form action="offline.php" method="POST" name="board">
			<?php foreach ($boards as $board): ?>
				<input name="board" type="submit" value="<?= $board ?>">
			<?php endforeach; ?>
		</form>
	</body>
</html>
