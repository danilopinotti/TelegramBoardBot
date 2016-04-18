<?php
	include "configs/application.php";
	include "BoardBot.php";

	$message = '';
	if(isset($_POST['change-board'])){
		$configs = new Configuration($telegramBotConfig["config_file"]);
		$configs->setConfiguration("last_board_off", $_POST['change-board']);
		$message = '<div class="alert alert-success" role="alert">Status alterado para <strong>'.$_POST['change-board'].'</strong></div>';
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
		<link rel="stylesheet" type="text/css" href="<?= ASSETS_FOLDER ?>/css/application.css">
		<link rel="stylesheet" type="text/css" href="<?= ASSETS_FOLDER ?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?= ASSETS_FOLDER ?>/css/bootstrap-theme.min.css">
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
		<?= $message ?>
		<div class="container">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Definir aviso
					</h3>
				</div>
				<div class="panel-body">
					<p>Escolha a placa para ser definida:</p>
					
					<form action="offline.php" method="POST" name="change-board">
						<?php foreach ($boards as $board): ?>
							<input name="change-board" type="submit" value="<?= $board ?>" class="btn btn-default">
						<?php endforeach; ?>
					</form>
				</div>
			</div>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">
						Criar novo aviso
					</h3>
				</div>
				<div class="panel-body">
					<form role="form" action="offline.php" method="POST" name="create-board">
						<label for="board-name">Nome do aviso:</label>
						<div class="form-group">
							<input type="text" class="form-control" id="board-name" name="boardName" placeholder="Nome do aviso" aria-describedby="boardName">
						</div>

						<label for="telegram-command">Comando telegram:</label>
						<div class="form-group">
							<div class="input-group"> 
								<span class="input-group-addon" id="telegram-command">/</span> 
								<input type="text" class="form-control" id="telegram-command" name="telegram-command" placeholder="Comando telegram" aria-describedby="telegramCommand">
							</div>
						</div>

						<label for="board-content">Conteúdo do aviso (HTML):</label>
						<div class="form-group">
						  <textarea class="form-control" rows="5" id="board-content" name="board-content"></textarea>
						</div>

						<div class="form-group"> 
						    <button type="submit" class="btn btn-default">Criar</button>
						</div>
					</form>

				</div>
			</div>
		</div>
		<script src="<?= ASSETS_FOLDER ?>/js/jquery-1.12.3.min.js"></script>
		<script src="<?= ASSETS_FOLDER ?>/js/bootstrap.js"></script>
	</body>
</html>
