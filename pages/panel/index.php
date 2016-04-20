<!DOCTYPE html>
<html>
	<head>
		<title><?= APP_NAME ?>: Painel Offline</title>
		<?= ViewHelpers::stylesheetIncludeTag("application.css", "bootstrap.min.css", "bootstrap-theme.min.css"); ?>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-4" aria-expanded="false">
						<span class="sr-only">
							Toggle navigation
						</span>
						<span class="icon-bar">
						</span>
						<span class="icon-bar">
						</span>
						<span class="icon-bar">
						</span>
					</button>
					<a class="navbar-brand" href="#">Aviso eletrônico</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-4">
					<p class="navbar-text">
						Desenvolvido em: UTFPR Câmpus Guarapuava por Danilo Pinotti
					</p>
				</div>
			</div>
		</nav>
		<?php foreach (Flash::message() as $flash_type => $flash_msg): ?>
         <div class="alert alert-<?= $flash_type ?>" role="alert">
           <a class="close" data-dismiss="alert">x</a>
           <p><?= $flash_msg ?></p>
         </div>
      <?php endforeach ?>
		<div class="container">
			<?php require "_boards_panel.php" ?>
			<?php require "_create_board_panel.php" ?>
		</div>
		<?= ViewHelpers::javascriptIncludeTag("jquery-1.12.3.min.js", "bootstrap.min.js") ?>
	</body>
</html>
