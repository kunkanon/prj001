<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<title>Sistema de saneamento básico</title>
		<link rel="stylesheet" type="text/css" href="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",$_SERVER['REQUEST_URI']); ?>tpl/css/main.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",$_SERVER['REQUEST_URI']); ?>tpl/bootstrap/css/bootstrap.min.css" >
	</head>
	<body>
		<div class="container">
			<div class="row"></div>
			<div class="textcenter">
				<h2>Realize seu cadastro para ter acesso à todas as funcionalidades</h2>	
			</div>
			<div class="textcenter">
				<div id="message-success">
					<span class="message-position"> CADASTRO REALIZADO COM ÊXITO. <a href="../">CLIQUE AQUI PARA REALIZAR LOGIN</a></span>
				</div>
				<div id="message-error">
					<span class="message-position"> ERRO AO REALIZAR O LOGIN. CONTACTE O ADMINISTRADOR...</span>
				</div>
			</div>
			
				<form>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Password</label>
      <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
  </div>
  <div class="form-group">
    <label for="inputAddress2">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">State</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Zip</label>
      <input type="text" class="form-control" id="inputZip">
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck">
      <label class="form-check-label" for="gridCheck">
        Check me out
      </label>
    </div>
  </div>
  <div class="form-group">
  <div class="form-group col-md-6">
  <button type="submit" class="btn btn-success">Sign in</button>
</div>
<div class="form-group col-md-6 float-right">
  <button type="submit" class="btn btn-danger float-right">Sign in</button>
</div>
</div>
</form>
			</div>
	</body>
	<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",$_SERVER['REQUEST_URI']); ?>tpl/js/jquery.min.js"></script>
	<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",$_SERVER['REQUEST_URI']); ?>tpl/js/main.js"></script>
	<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",$_SERVER['REQUEST_URI']); ?>tpl/bootstrap/js/bootstrap.min.js"></script>
</html>