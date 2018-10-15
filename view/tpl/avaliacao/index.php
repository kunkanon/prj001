<?php session_start(); 
if(!isset($_SESSION['main']['user']) && !isset($_SESSION['main']['dt'])){
  header('Location: ../index.php?out=sucess');
}else{
  $usrsession = $_SESSION['main']['user'];
  $dtini = $_SESSION['main']['dt'];
  $colhid = $_SESSION['main']['colid'];
  if(isset($_SESSION['main']['empresa']) && $_SESSION['main']['empresa']==true){
    $type = "pj";
  }else{
    $type = "usr";
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
    <input type="text" id="colhid" name="colhid" value="<?php echo $colhid; ?>">
    <input type="text" id="typehid" name="typehid" value="<?php echo $type; ?>">
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
        <h2 class="text-center text-uppercase text-secondary mb-0">AVALIAR COLETA</h2>
        <hr class="star-dark mb-5">
        <div class="row text-center">
          <div class="col-lg-12 mx-auto text-center">
            <form id="fnewcoleta" name="fnewcoleta">

            <?php 
            $arrcount = count($_SESSION['main']['rating']['columnames']);
            $placeholder = $_SESSION['main']['rating']['placeholder'];
            foreach($_SESSION['main']['rating']['columnames'] as $key => $values){
              if($key==$arrcount-1){
                print('
                  <div class="control-group float-left col-lg-6 ">
                  <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>'.$placeholder[$key].'</label>
                  <input class="form-control" id="doc_'.$key.'" name="doc_'.$key.'" type="file" placeholder="'.$placeholder[$key].'" required="required" data-validation-required-message="Por favor informe: '.$placeholder[$key].'.">
                  <p class="help-block text-danger"></p>
                  </div>
                  </div>
                ');
              }elseif($key==$arrcount-2){
                  print('
                <div class="control-group float-left col-lg-6 ">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>'.$placeholder[$key].'</label>
                <input class="form-control" id="field_'.$key.'" name="field_'.$key.'" type="text" placeholder="'.$placeholder[$key].'" required="required" data-validation-required-message="Por favor informe: '.$placeholder[$key].'." value="'.$_SESSION['main']['rating']['values'][$key].'">
                <p class="help-block text-danger"></p>
                </div>
                </div>
                ');
              }else{

              print('
                <div class="control-group float-left col-lg-6 ">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label>'.$placeholder[$key].'</label>
                <input class="form-control" min="1" max="5" id="field_'.$key.'" name="field_'.$key.'" type="number" placeholder="'.$placeholder[$key].'" required="required" data-validation-required-message="Por favor informe: '.$placeholder[$key].'." value="'.$_SESSION['main']['rating']['values'][$key].'">
                <p class="help-block text-danger"></p>
                </div>
                </div>
                ');
              }
            }
            if($arrcount % 2 != 0 ){
              print('
                <div class="control-group  col-lg-6" style="z-index: -1000;border:none">
                <div class="form-group floating-label-form-group controls mb-0 pb-2" style="z-index: -1000;border:none">
                  <input class="form-control" style="border:none">
                </div></div>
                ');
            }
              ?>
              <div class="form-group text-center">
                <button type="button" name="updaterating" class="btn btn-primary btn-xl col-md-6" id="updaterating">ENVIAR AVALIAÇÂO</button>
              </div>
            </form>
          </div>
        </div>
        </div>
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