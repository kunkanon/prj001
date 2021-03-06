<?php session_start(); 
if(!isset($_SESSION['main']['user']) && !isset($_SESSION['main']['dt'])){
  header('Location: ../index.php?out=sucess');
}else{
  $usrsession = $_SESSION['main']['user'];
  $dtini = $_SESSION['main']['dt'];
  if(!isset($_SESSION['main']['table']['mycols'][$dtini][$usrsession])){
    $_SESSION['main']['table']['mycols'][$dtini][$usrsession] = "Nenhuma coleta encontrada";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<title>Sistema de saneamento básico</title>
		<link rel="stylesheet" type="text/css" href="../tpl/bootstrap/css/bootstrap.min.css" >
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    	<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="../tpl/css/magnific-popup.css" >
		<link rel="stylesheet" type="text/css" href="../tpl/css/main.css" >
	</head>
	<body id="page-top">
    <input type="text" id="pjhid" name="pjhid" value="<?php echo $usrsession; ?>">
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
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../main/">Painel</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../coletas/">Coletas</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../relatorio/">Relatórios</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="../index.php?out=success">Sair</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <section id="register">
      <div class="container" style="padding-top: 30px">
        <h2 class="text-center text-uppercase text-secondary mb-0">MINHAS COLETAS</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-12 mx-auto text-center">
            <table id="tbl-dash-coleta" class="table table-striped table-hover">
              <?php print($_SESSION['main']['table']['mycols'][$dtini][$usrsession]); ?>
              </table>
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
  
    <script src="../tpl/js/jquery.min.js"></script>
    <script src="../tpl/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="../tpl/js/jquery.easing.min.js"></script>
    <script src="../tpl/js/jquery.magnific-popup.min.js"></script>
    <script src="../tpl/js/jqBootstrapValidation.js"></script>
    <script src="../tpl/js/main.js"></script>
    <script src="../tpl/js/sweetalert2.all.min.js"></script>
  </body>
</html>