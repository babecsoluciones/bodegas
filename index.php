<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();

date_default_timezone_set('America/America/Mexico_City');

if(!$_SESSION['sessionAdmin'])
{
	echo '<script>window.location="login.php";</script>';
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>SGB | Dashboard</title>

    <!-- Fontfaces CSS-->
    <link href="css/font-face.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme.css" rel="stylesheet" media="all">
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    
    <!--Autocomplete-->
    <link href="dist/easy-autocomplete.min.css" rel="stylesheet" type="text/css">
	<script src="lib/jquery-1.11.2.min.js"></script>
	<script src="dist/jquery.easy-autocomplete.min.js" type="text/javascript" ></script>

    <!--DatePicker-->
    <link rel="stylesheet" type="text/css" href="https://rawgithub.com/cletourneau/angular-bootstrap-datepicker/master/dist/angular-bootstrap-datepicker.css">
    
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <header class="header-mobile d-block d-lg-none">
            <div class="header-mobile__bar">
                <div class="container-fluid">
                    <div class="header-mobile-inner">
                        <a class="logo" href="index.html">
                            <img src="images/icon/logo-black.png" alt="SGE" />
                        </a>
                        <button class="hamburger hamburger--slider" type="button">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
            <nav class="navbar-mobile">
                <div class="container-fluid">
                    <ul class="navbar-mobile__list list-unstyled">
                        <li class="active">
                            <a class="js-arrow" href="index.php?tCodSeccion=inicio">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
						<?
						echo $clSistema->generarMenu();
						?>
                        
                    </ul>
                </div>
            </nav>
        </header>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar d-none d-lg-block">
            <div class="logo">
                <a href="index.php?tCodSeccion=inicio">
                    <img src="images/icon/logo-black.png" alt="SWGC" />
                </a>
            </div>
            <div class="menu-sidebar__content js-scrollbar1">
                <nav class="navbar-sidebar">
                    <ul class="list-unstyled navbar__list">
                        <li <?=$_GET['tCodSeccion']=='inicio' ? 'class="active"' : '' ?>>
                            <a class="js-arrow" href="index.php?tCodSeccion=inicio">
                                <i class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
						<?
						echo $clSistema->generarMenu();
						?>
                        
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" action="" method="POST">
                                <!--<input class="au-input au-input--xl" type="text" name="search" placeholder="Search for datas &amp; reports..." />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>-->
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
                                            <img src="images/icon/logo.png" alt="<?=$_SESSION['sessionAdmin'][0]['tNombre']?>" width="100" height="100"/>
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?=$_SESSION['sessionAdmin'][0]['tNombre']?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
                                                        <img src="images/icon/logo.png" width="100" height="100"/>
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?=$_SESSION['sessionAdmin'][0]['tNombre']?></a>
                                                    </h5>
                                                    <span class="email"><?=$_SESSION['sessionAdmin'][0]['tCorreo']?></span>
                                                </div>
                                            </div>
                                           
                                            <div class="account-dropdown__footer">
                                                <a href="#" onclick="cerrarSesion()">
                                                    <i class="zmdi zmdi-power"></i>Salir</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <?
    if($_POST['transaccion'])
{
    $eCodEvento = $_POST['eCodEventoTransaccion'];
    $dMonto = $_POST['dMonto'];
    $fhFecha = "'".date('Y-m-d H:i:s')."'";
    $eCodTipoPago = $_POST['eCodTipoPago'];
    $eCodUsuario = $_SESSION['sessionAdmin'][0]['eCodUsuario'];
    
        $insert = "INSERT INTO BitTransacciones (eCodUsuario,eCodEvento,fhFecha,dMonto,eCodTipoPago) VALUES ($eCodUsuario,$eCodEvento,$fhFecha,$dMonto,$eCodTipoPago)";
    mysql_query($insert);
        
       //$pf = fopen("log.txt","w");
       //fwrite($pf,$insert);
       //fclose($pf);
        
        $tDescripcion = "Se ha registrado una transaccion por ".number_format($dMonto,2)." en el evento ".sprintf("%07d",$eCodEvento);
                $tDescripcion = "'".$tDescripcion."'";
                mysql_query("INSERT INTO SisLogs (eCodUsuario, fhFecha, tDescripcion) VALUES ($eCodUsuario, $fhFecha, $tDescripcion)");
        
    mysql_query("UPDATE BitEventos SET eCodEstatus = 2 WHERE eCodEvento = ".$eCodEvento);
    ?>
 <div class="alert alert-success" role="alert">
                Transacci&oacute;n guardada correctamente!
            </div>
<script>
setTimeout(function(){
    window.location="?tCodSeccion=<?=$_GET['tCodSeccion']?>";
},2500);
</script>
<?
}
    ?>
                    <div class="container-fluid">
                        
						<?	

							$tCodSeccion = $clSistema->cargarSeccion($_GET['tCodSeccion']);
						
						?>
                        
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="copyright">
                                    <p>Derechos Reservados © <?=date('Y')?> S.G.B. - Desarrollado por <a href="#">SDI·BABEC</a>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END MAIN CONTENT-->
            <!-- END PAGE CONTAINER-->
        </div>

    </div>
    
    <!--transacciones-->
    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
          <form action="?tCodSeccion=<?=$_GET['tCodSeccion']?>" method="post">
              <input type="hidden" id="eCodEventoTransaccion" name="eCodEventoTransaccion">
            <label>Monto: $<input type="text" class="form-control" name="dMonto" id="dMonto" required></label><br>
            <label>Forma de pago: 
              <select name="eCodTipoPago" id="eCodTipoPago">
                <?
    $select = "SELECT * FROM CatTiposPagos ORDER BY tNombre ASC";
                                        $rsTiposPagos = mysql_query($select);
                                        while($rTipoPago = mysql_fetch_array($rsTiposPagos))
                                        {
                                            ?>
                  <option value="<?=$rTipoPago{'eCodTipoPago'}?>"><?=$rTipoPago{'tNombre'}?></option>
                  <?
                                        }
    ?>
                </select>
              </label><br>
              <input type="submit" value="Guardar" name="transaccion" class="btn btn-info">
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        </div>
      </div>
      
    </div>
  </div>
 

    <!-- Jquery JS-->
    <script src="vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="vendor/slick/slick.min.js">
    </script>
    <script src="vendor/wow/wow.min.js"></script>
    <script src="vendor/animsition/animsition.min.js"></script>
    <script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="vendor/circle-progress/circle-progress.min.js"></script>
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="vendor/select2/select2.min.js">
    </script>

    <!-- Main JS-->
    <script src="js/main.js"></script>
	<script src="js/aplicacion.js"></script>
	
	<!--Search-->
	<script type="text/javascript" src="//code.jquery.com/jquery-1.7.1.js"></script>
   
  <script type="text/javascript">
 
    $(window).load(function(){
      
var $rows = $('#table tbody tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
        
        var $rows2 = $('#table2 tbody tr');
$('#search2').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
    
    $rows2.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});

    });
      
      function agregarTransaccion(codigo)
      {
          document.getElementById('eCodEventoTransaccion').value = codigo;
      }

</script>
    
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
<script src="https://rawgithub.com/cletourneau/angular-bootstrap-datepicker/master/dist/angular-bootstrap-datepicker.js" charset="utf-8"></script>
<script>
$('#datepicker').datepicker();


function obtenerFecha()
{
var fecha = $("#datepicker").datepicker( 'getDate' );
var fhFecha = new Date(fecha);
document.getElementById('datepicker1').value = fhFecha.getDate()+'-'+fhFecha.getMonth()+'-'+fhFecha.getFullYear();
}
</script>  

</body>

</html>
<!-- end document-->
