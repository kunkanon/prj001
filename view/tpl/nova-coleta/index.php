<?php session_start(); 
if(!isset($_SESSION['main']['user']) && !isset($_SESSION['main']['dt']) && 
   !isset($_SESSION['main']['newcol'][$dtini][$usrsession])){
  header('Location: ../index.php?out=sucess');
}else{
  $dtini = $_SESSION['main']['dt'];
  $usrsession = $_SESSION['main']['user'];
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
		<link rel="stylesheet" type="text/css" href="../tpl/css/magnific-popup.css">
		<link rel="stylesheet" type="text/css" href="../tpl/css/main.css">
	</head>
	<body id="page-top">
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
        <h2 class="text-center text-uppercase text-secondary mb-0">CADASTRAR NOVA COLETA</h2>
        <hr class="star-dark mb-5">
        <div class="text-center">
            <h4 class="text-uppercase mb-4">
              Coleta do tipo <?php 

                if(isset($_SESSION['main']['newcol']['name'][$dtini][$usrsession])){
                  echo ucfirst($_SESSION['main']['newcol']['name'][$dtini][$usrsession]); 
                }else if(isset($_SESSION['main']['newcol']['cod_coleta'][$dtini][$usrsession])){
                  echo ucfirst($_SESSION['main']['newcol']['cod_coleta'][$dtini][$usrsession]);
                }
                    ?>
            </h4>
        </div>
        <div class="row">
          <div class="col-lg-12 mx-auto">
            <form id="fnewcoleta" name="fnewcoleta">
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>DIA PADRÃO:</label>
                  <input class="form-control" id="newcolday" name="newcolday" type="number" placeholder="DIA PREFERENCIAL" required="required" data-validation-required-message="Por favor informe: dia preferencial.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2 floating-label-form-group-with-value floating-label-form-group-with-focus">
                  <label style='z-index: -1'>LIXO CHEIO?</label>
                  <select class="form-control" id="newcoltrash" name="newcoltrash">
                    <option value="">SELECIONE...</option>
                    <option value="S">SIM</option>
                    <option value="N">NÂO</option>
                  </select>
                </div>
              </div>
              <div class="control-group float-left col-lg-6">
                <div class="form-group floating-label-form-group controls mb-0 pb-2 floating-label-form-group-with-value floating-label-form-group-with-focus" >
                  <label style='z-index: -1'>COLETA ATIVA?</label>
                  <select class="form-control" id="newcolcol" name="newcolcol">
                    <option value="">SELECIONE...</option>
                    <option value="S">SIM</option>
                    <option value="N">NÂO</option>
                  </select>
                </div>
              </div>
              <input class="form-control" id="newcolcolhid" name="newcolcolhid" type="text">
              <input class="form-control" id="newcoltrashhid" name="newcoltrashhid" type="text">
              <input class="form-control" id="newcolid" name="newcolid" type="text" value="<?php echo $_SESSION['main']['newcol']['code'][$dtini][$usrsession]; ?>">
              <br>
              <div id="success"></div>
              <div class="form-group text-center">
                <button type="button" name="newcolregister" class="btn btn-primary btn-xl col-md-6" id="newcolregister">Confirmar</button>
              </div>
              <div class="form-group text-center">
                <button type="button" name="updatecolregister" class="btn btn-primary btn-xl col-md-6" id="updatecolregister">Atualizar</button>
              </div>
            </form>
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
    <input type='text' id="usridhid" name="usridhid" value='<?php echo $_SESSION['main']['user']; ?>'>
  
    <script src="../tpl/js/jquery.min.js"></script>
    <script src="../tpl/bootstrap/js/bootstrap.min.js"></script>
    
    <script src="../tpl/js/jquery.easing.min.js"></script>
    <script src="../tpl/js/jquery.magnific-popup.min.js"></script>
    <script src="../tpl/js/jqBootstrapValidation.js"></script>
    <script src="../tpl/js/main.js"></script>
    <script src="../tpl/js/sweetalert2.all.min.js"></script>
    <!--<script src="../tpl/js/promise-polyfill"></script>-->
    <script type="text/javascript">
      $(document).ready(function(){
        $("#updatecolregister").hide();
      });
    </script>
    <?php if(isset($_SESSION['main']['newcol']['edit'][$dtini][$usrsession]) && !empty($_SESSION['main']['newcol']['edit'][$dtini][$usrsession])){ ?>
      <script type="text/javascript">
          $(document).ready(function(){
              $("#newcolregister").hide();
              $("#updatecolregister").show();
              $("#newcoltrash").val("<?php echo $_SESSION['main']['newcol']['lixo'][$dtini][$usrsession]; ?>");
              $("#newcolcol").val("<?php echo $_SESSION['main']['newcol']['col_ativa'][$dtini][$usrsession]; ?>");
              $("#newcolday").val("<?php echo $_SESSION['main']['newcol']['dia'][$dtini][$usrsession]; ?>");
              $("#newcolid").val("<?php echo $_SESSION['main']['newcol']['code'][$dtini][$usrsession]; ?>");

              $("#newcolcolhid").val($("#newcolcol").val());
              $("#newcolday").val($("#newcolday").val());
              $("#newcoltrashhid").val($("#newcoltrash").val());
              $("#newcolid").val($("#newcolid").val());

              /*$_SESSION['main']['newcol'][$dtini][$usrsession]
              $_SESSION['main']['newcol']['code'][$dtini][$usrsession]
              $_SESSION['main']['newcol']['cod_usu'][$dtini][$usrsession]
              $_SESSION['main']['newcol']['cod_coleta'][$dtini][$usrsession]
              $_SESSION['main']['newcol']['col_ativa'][$dtini][$usrsession]
              $_SESSION['main']['newcol']['lixo'][$dtini][$usrsession]
              $_SESSION['main']['newcol']['dia'][$dtini][$usrsession]*/

            $("#updatecolregister").click(function(e){
                  e.preventDefault();
                  processdata = {
                  'type' : 'updatecolregister',
                  'diacol' : $("#newcolday").val(),
                  'trashfull' : $("#newcoltrashhid").val(),
                  'active' : $("#newcolcolhid").val(),
                  'idcol' : $("#newcolid").val()
                };
                $.ajax({
                  url: '../../control/o.new.coleta.php',
                  data: processdata,
                  type: "POST",
                  dataType: "JSON"
                }).done(function(result){
                  if(result[0]==1){
                    swal(
                      'Sucesso!',
                      'Coleta atualizada com sucesso!',
                      'success'
                    )
                    var routedata = {
                      'type' : 'mycols',
                      'code' : "<?php echo $_SESSION['main']['user']; ?>"
                    }
                    $.ajax({
                      url: '../../control/routes.php',
                      data: routedata,
                      type: "POST",
                        dataType: "JSON"
                    }).done(function(resultset){
                      if(resultset[0]==1){
                        <?php unset($_SESSION['main']['newcol']['edit'][$dtini][$usrsession]); ?>
                        window.location="../"+resultset[1]+"/index.php?gs="+resultset[2]+"&gd="+resultset[3];
                      }else{
                        swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Algo deu errado'
                        })
                      }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                      console.log(jqXHR.responseText);
                      swal({
                          type: 'error',
                          title: 'Oops...',
                          text: 'Algo deu errado'
                        })
                    })
                  }
                }).fail(function(jqXHR, textStatus, errorThrown){
                  console.log(jqXHR.responseText);
                  swal({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Algo deu errado'
                    })
                })

            });


          });
      </script>
    <?php } ?>
  </body>
</html>