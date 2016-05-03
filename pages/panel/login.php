<?php
	if ($_POST["pass"] == $access_pwd){
		SessionHelpers::logIn("default");
		ViewHelpers::redirectTo("index.php");
	}
	else{
		Flash::message('danger', 'Senha inválida');
      	ViewHelpers::redirectTo('../../index.php');
	}
?>