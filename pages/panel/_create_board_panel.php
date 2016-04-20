<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">
			Criar novo aviso
		</h3>
	</div>
	<div class="panel-body">
		<form role="form" action="create.php" method="POST" name="create-board">
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