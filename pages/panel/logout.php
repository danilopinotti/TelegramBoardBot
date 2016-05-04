<?php
	unset($_SESSION["user"]);
	Flash::message("success","Você foi deslogado.");
	ViewHelpers::redirectTo("../../index.php");
?>