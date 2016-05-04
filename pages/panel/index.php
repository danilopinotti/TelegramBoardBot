<?php
	SessionHelpers::shouldBeAutenticated();
?>
<!DOCTYPE html>
<html>
	<head>
		<title><?= APP_NAME ?>: Painel Offline</title>
		<meta charset="UTF-8">
		<?= ViewHelpers::stylesheetIncludeTag("application.css", "bootstrap.min.css", "bootstrap-theme.min.css"); ?>
	</head>
	<body>
		<nav class="navbar navbar-default">
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="#">Aviso eletrônico</a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li><?= ViewHelpers::linkTo("/board", "Ver aviso") ?></li>
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="logout.php">Logout</a></li>
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
		<?php foreach (Flash::message() as $flash_type => $flash_msg): ?>
         <div class="alert alert-<?= $flash_type ?>" role="alert">
           <a class="close" data-dismiss="alert">x</a>
           <p><?= $flash_msg ?></p>
         </div>
      <?php endforeach ?>
		<div class="container">
			<?php require "_boards_panel.php" ?>
			<?php //require "_create_board_panel.php" ?>
		</div>
		<?= ViewHelpers::javascriptIncludeTag("jquery-1.12.3.min.js", "bootstrap.min.js") ?>
	</body>
</html>
