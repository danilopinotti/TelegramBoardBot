<?php
	if(isset($_POST['change-board'])){
		$configs = new Configuration($telegramBotConfig["config_file"]);
		$configs->setConfiguration("last_board_off", $_POST['change-board']);
		flash('success','Status alterado para <strong>'.$_POST['change-board'].'</strong>');
	}
	header("location: index.php");
?>