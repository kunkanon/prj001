<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Sistema de saneamento básico</title>
	<link rel="stylesheet" type="text/css" href="<?php echo str_replace('index.php',"",$_SERVER['REQUEST_URI']); ?>tpl/css/main.css" >
	</head>
	<body>
		<div class="wrapper">
			<div class="container">
				<div class="wrap-login">
					<form action="" class="form-login">
						<span class="span-login">
							Acesso ao sistema
						</span>
						<div class="wrap-input-login">
							<input class="input-login" type="email" placeholder="Email" name="loginEmail" id="loginEmail">
						</div>
						<div class="wrap-input-login">
							<input class="input-login" type="password" placeholder="Senha" name="loginPswd" id="loginPswd">
						</div>
						<div class="login-btn">
							<button class="login-btn-input">Acessar</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		
	</body>
	<script src="<?php echo str_replace('index.php',"",$_SERVER['REQUEST_URI']); ?>tpl/js/main.js"></script>
</html>