<?php 
	$boards = FileHelpers::filesInDirectory($telegramBotConfig["boards_folder"], true);
?>
<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			Definir aviso
		</h3>
	</div>
	<div class="panel-body">
		<p>Escolha a placa para ser definida:</p>
		
		<form action="change.php" method="POST" name="change-board">
			<?php foreach ($boards as $board): ?>
				<input name="change-board" type="submit" value="<?= $board ?>" class="btn btn-default">
			<?php endforeach; ?>
		</form>
	</div>
</div>