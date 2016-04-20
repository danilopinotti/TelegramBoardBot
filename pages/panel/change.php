<?php
	if(isset($_POST['change-board'])){
		$configs = new ConfigurationFile($telegramBotConfig["config_file"]);
		$configs->setConfiguration("last_board_off", $_POST['change-board']);
		Flash::message('success','Status alterado para <strong>'.$_POST['change-board'].'</strong>');
	}
	header("location: index.php");
?>
