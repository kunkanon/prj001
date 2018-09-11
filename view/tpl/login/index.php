<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Sistema de saneamento básico</title>
	<link rel="stylesheet" type="text/css" href="<?php echo str_replace('index.php',"",$_SERVER['REQUEST_URI']); ?>tpl/css/main.css" >
	</head>
	<body>
		<div class="container">
			<div class="pagetitle text-centered">
				<h2>Sistema de saneamento básico</h2>	
			</div>
			<div class="row col-12">
				<form id="flogin" name="flogin" method="POST" class="col-12">
					<div class="form-group">
						<span class="form-text text-muted"> Informe suas credenciais para acesso ao sistema </span>	
					</div>
					
					<div class="form-group ">
						<input class="form-control" type="email" placeholder="DIGITE SEU EMAIL" name="loginEmail" id="loginEmail">
					</div>
					<div class="form-group">
						<input class="form-control" type="password" placeholder="DIGITE SUA SENHA" name="loginPswd" id="loginPswd">
					</div>
					<div class="form-group">
						<button name="btn-login-submit" id="btn-login-submit" class="btn btn-success btn-lg btn-block" id="">ACESSAR</button>
					</div>
				</form>
			</div>
		</div>
	</body>
	<script src="<?php echo str_replace('index.php',"",$_SERVER['REQUEST_URI']); ?>tpl/js/jquery.min.js"></script>
	<script src="<?php echo str_replace('index.php',"",$_SERVER['REQUEST_URI']); ?>tpl/js/main.js"></script>
</html>