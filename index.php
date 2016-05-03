<!DOCTYPE html>
<html>
	<head>
		<title><?= APP_NAME ?>: Painel Offline</title>
		<meta charset="UTF-8">
		<?= ViewHelpers::stylesheetIncludeTag("application.css", "bootstrap.min.css", "bootstrap-theme.min.css"); ?>
	</head>
	<body>
		<?php foreach (Flash::message() as $flash_type => $flash_msg): ?>
			<div class="alert alert-<?= $flash_type ?>" role="alert">
				<a class="close" data-dismiss="alert">x</a>
				<p><?= $flash_msg ?></p>
			</div>
		<?php endforeach ?>
		
		<?= ViewHelpers::linkTo("#", "Panel", 'data-toggle="modal" data-target="#login-modal"') ?>
		<br>
		<?= ViewHelpers::linkTo("/board", "Board") ?>

		<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<div class="loginmodal-container">
					<h1>Senha de acesso</h1><br>
					<form action="<?= ViewHelpers::urlFor('/pages/panel/login.php') ?>" method="POST">
						<input type="password" name="pass" placeholder="Password">
						<input type="submit" name="login" class="login loginmodal-submit" value="Login">
					</form>
				</div>
			</div>
		</div>
		<?= ViewHelpers::javascriptIncludeTag("jquery-1.12.3.min.js", "bootstrap.min.js") ?>
	</body>
</html>