<?php session_start(); 
if(isset($_GET['out']) && !empty($_GET['out'])){
  unset($_SESSION['main']);
  unset($_SESSION['main']['empresa']);
  header('Location: ../view/');
}
$pj = (isset($_GET['pj']) ? 2 : 1 );
$linkpj = (!isset($_GET['pj']) ? '<h4 class="font-weight-light mb-0"><a href="index.php?pj=x#register" >Pessoa jurídica clique aqui</a> </h4>': "" );
$cpfcnpj = (isset($_GET['pj']) ? "CNPJ" : "CPF" );
$nome = (isset($_GET['pj']) ? "Empresa" : "Nome" );
$display = (isset($_GET['pj']) ? "css-display-none" : "" );
?>
<!-- https://blackrockdigital.github.io/startbootstrap-freelancer/ -->
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<title>Sistema de saneamento básico</title>
		<link rel="stylesheet" type="text/css" href="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/bootstrap/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/css/magnific-popup.css" >
		<link rel="stylesheet" type="text/css" href="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/css/main.css" >
	</head>
	<body id="page-top">
      <input type="text" id="pjhid" name="pjhid" value="<?php echo $pj; ?>">
		<nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Sistema de saneamento básico</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#login">Acessar</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#register">Cadastro</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#aboutus">Sobre nós</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/images/mainimage.png" alt="">
        <h1 class="text-uppercase mb-0">Coleta inteligente</h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Gerenciamento digital de coleta de lixo </h2>
      </div>
    </header>

    <section id="register">
    	<div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Cadastre-se</h2>
        <hr class="star-dark mb-5">

        <div class="row">

          <?php echo $linkpj; ?>

          <div class="col-lg-12 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form id="fregister" name="fregister">
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label><?php echo $nome; ?></label>
                  <input class="form-control" id="registername" name="registername" type="text" placeholder="<?php echo $nome; ?>" required="required" data-validation-required-message="Por favor informe: name.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-right col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email</label>
                  <input class="form-control" id="registeremail" name="registeremail" type="email" placeholder="Email" required="required" data-validation-required-message="Por favor informe: email.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              
              <div class="control-group float-right col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Senha</label>
                  <input class="form-control" id="registerpswd" name="registerpswd" type="password" placeholder="Senha" required="required" data-validation-required-message="Por favor informe: senha.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>

              
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label><?php echo $cpfcnpj; ?></label>
                  <input class="form-control" id="registercpf" name="registercfp" type="text" placeholder="<?php echo $cpfcnpj; ?>" required="required" data-validation-required-message="Por favor informe: cpf.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-right col-lg-6 <?php echo $display; ?>">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>RG</label>
                  <input class="form-control" id="registerrg" name="registerrg" type="text" placeholder="RG" required="required" data-validation-required-message="Por favor informe: rg.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Endereço</label>
                  <input class="form-control" id="registeraddress" name="registeraddress" type="text" placeholder="Endereço" required="required" data-validation-required-message="Por favor informe: endereço.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-right col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Número</label>
                  <input class="form-control" id="registernumber" name="registernumber" type="number" placeholder="Número" required="required" data-validation-required-message="Por favor informe: número.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>CEP</label>
                  <input class="form-control" id="registercep" name="registercep" type="number" placeholder="CEP" required="required" data-validation-required-message="Por favor informe: CEP.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-right col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Bairro</label>
                  <input class="form-control" id="registerbairro" name="registerbairro" type="text" placeholder="Bairro" required="required" data-validation-required-message="Por favor informe: Bairro.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Cidade</label>
                  <input class="form-control" id="registercidade" name="registercidade" type="text" placeholder="Cidade" required="required" data-validation-required-message="Por favor informe: Cidade.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-right col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Estado</label>
                  <input class="form-control" id="registerestado" name="registerestado" type="text" placeholder="Estado" required="required" data-validation-required-message="Por favor informe: Estado.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-right col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2 floating-label-form-group-with-value floating-label-form-group-with-focus">
                  <label style='z-index: -1'>Quantidade de litros (lixeira)</label>
                  <select class="form-control" id="registerlitrosel" name="registerlitrosel">
                    <option value="0">SELECIONE</option>
                    <option value="10">10L</option>
                    <option value="20">20L</option>
                    <option value="60">60L</option>
                    <option value="100">100L</option>
                  </select>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <input class="form-control" id="registerlitro" name="registerlitro" type="text" placeholder="Quantidade de litros (lixeira)" required="required" data-validation-required-message="Por favor informe: litro.">
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                	<label>Telefone</label>
                  	<input class="form-control" id="registerphone" name="registerphone" type="tel" placeholder="Telefone" required="required" data-validation-required-message="Por favor informe: telefone.">
                  	<p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group  col-lg-6" style="z-index: -1000;border:none">
                <div class="form-group floating-label-form-group controls mb-0 pb-2" style="z-index: -1000;border:none">
                  <input class="form-control" style="border:none">
                </div></div>
              <div id="success"></div>
              <div class="form-group text-center">
                <button type="button" class="btn btn-primary btn-xl col-md-6" id="registerButton">Confirmar Cadastro</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-primary text-white mb-0" id="aboutus">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">About</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
          </div>
        </div>
        <div class="text-center mt-4">
          <a class="btn btn-xl btn-outline-light" href="#">
            <i class="fas fa-download mr-2"></i>
            Download Now!
          </a>
        </div>
      </div>
    </section>
    <section id="login">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Acesse o sistema</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form name="formaccess" id="formaccess" method="POST">
              <div class="control-group col-lg-12">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Email</label>
                  <input class="form-control" name="accessemail" id="accessemail" type="text" placeholder="Email" required="required" data-validation-required-message="Por favor informe seu email.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group col-lg-12">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                	<label>Senha</label>
                  	<input class="form-control" id="accesspass" name="accesspass" type="password" placeholder="Senha" required="required" data-validation-required-message="Por favor informe sua senha.">
                  	<p class="help-block text-danger"></p> 
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group text-center">
                <button type="button" class="btn btn-primary btn-xl col-md-6" id="btn-login-submit">Entrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Location</h4>
            <p class="lead mb-0">2215 John Daniel Drive
              <br>Clark, MO 65243</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Around the Web</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-google-plus-g"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-linkedin-in"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                  <i class="fab fa-fw fa-dribbble"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">About Freelancer</h4>
            <p class="lead mb-0">Freelance is a free to use, open source Bootstrap theme created by
              <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; Your Website 2018</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>
	
		<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/js/jquery.min.js"></script>
		<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/bootstrap/js/bootstrap.min.js"></script>
		
		<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/js/jquery.easing.min.js"></script>
		<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/js/jquery.magnific-popup.min.js"></script>
		<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/js/jqBootstrapValidation.js"></script>
		<script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/js/main.js"></script>
    <script src="<?php echo str_replace(array(basename(__DIR__),'index.php'),"",strstr($_SERVER['REQUEST_URI'],"?",true)); ?>tpl/js/sweetalert2.all.min.js"></script>
	</body>
</html>