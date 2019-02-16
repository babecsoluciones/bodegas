<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
require_once("lstTiposDocumentos.php");
$clSistema = new clSis();
session_start();

$bAll = $clSistema->validarPermiso($_GET['tCodSeccion']);

$fhFechaInicio = $_POST['fhFechaConsulta'] ? date('Y-m-d',strtotime("+1 month",strtotime($_POST['fhFechaConsulta']))).' 00:00:00' : date('Y-m-d').' 00:00:00';
$fhFechaTermino = $_POST['fhFechaConsulta'] ? date('Y-m-d',strtotime("+1 month",strtotime($_POST['fhFechaConsulta']))).' 23:59:59' : date('Y-m-d').' 23:59:59';

$fhFechaConsulta = $_POST['fhFechaConsulta'] ? date('Y-m-d',strtotime("+1 month",strtotime($_POST['fhFechaConsulta']))).' 00:00:00' : date('Y-m-d').' 00:00:00';

$fhFechaInicio = "'".$fhFechaInicio."'";
$fhFechaTermino = "'".$fhFechaTermino."'";


?>

<div class="row">
<!--calendario-->
    <div class="col-lg-4" >
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40" id="datepicker" onclick="obtenerFecha()"></div>
        <center>
        <form id="Datos" method="post" action="<?=$_SERVER['PHP_SELF']?>?tCodSeccion=inicio">
    <input type="hidden" name="fhFechaConsulta" id="datepicker1">
    <input type="submit" class="btn btn-info" value="Consultar">
    </form>
        </center>
    </div>
<!--calendario-->
<!--Listado de eventos de ese día-->
<div class="col-lg-8">
    <?
    for($i=0;$i<sizeof($lstTiposDocumentos);$i++)
    {
    
    $eCodTipoDocumento =   $lstTiposDocumentos[$i]['eCodTipoDocumento'];  
    $tNombre =  $lstTiposDocumentos[$i]['tNombre'];  
    $tEnlace =  $lstTiposDocumentos[$i]['enlace']; 
    $tFondo =  $lstTiposDocumentos[$i]['fondo']; 
    $select = "SELECT be.*, cc.tNombres nombreCliente, cc.tApellidos apellidosCliente,
															su.tNombre as promotor, ce.tNombre Estatus FROM BitEventos be INNER JOIN CatClientes cc ON cc.eCodCliente = be.eCodCliente
															INNER JOIN CatEstatus ce ON ce.eCodEstatus = be.eCodEstatus
														LEFT JOIN SisUsuarios su ON su.eCodUsuario = be.eCodUsuario
                                                        WHERE
                                                        be.fhFechaEvento between $fhFechaInicio AND $fhFechaTermino".
                                                        " AND be.eCodEstatus<>4".
                                                        " AND be.eCodTipoDocumento=$eCodTipoDocumento".
												        ($bAll ? "" : " AND cc.eCodUsuario = ".$_SESSION['sessionAdmin'][0]['eCodUsuario']).
														" ORDER BY be.fhFechaEvento DESC";
														
$rsEventos = mysql_query($select);
    ?>
                                <div class="au-card au-card--no-shadow au-card--no-pad m-b-40">
                                    <div class="au-card-title" style="background-image:url('images/<?=$tFondo?>');">
                                        <div class="bg-overlay bg-overlay--blue"></div>
                                        <h3>
                                            <i class="zmdi zmdi-account-calendar"></i><?=$tNombre?> del d&iacute;a</h3>
                                         <? if($clSistema->validarEnlace('oper-<?=$tEnlace?>-reg')) { ?>
	                                           <button class="au-btn-plus" onclick="window.location='index.php?tCodSeccion=oper-<?=$tEnlace?>-reg'" alt="Nuevo Evento"><i class="zmdi zmdi-plus"></i></button>
                                           <? } ?>
                                       
                                           
                                    </div>
                                    <div class="au-task js-list-load">
                                        <div class="au-task__title">
                                            <p><?=date('d/m/Y',strtotime($fhFechaConsulta))?></p>
                                        </div>
                                        <div class="au-task-list js-scrollbar3">
                                            <?
                                                if(mysql_num_rows($rsEventos))
                                                {
                                                    while($rEvento = mysql_fetch_array($rsEventos))
                                                    {
                                                        ?>
                                                <div class="au-task__item au-task__item--primary">
                                                    <div class="au-task__item-inner">
                                                        <h5 class="task">
                                                            <a href="?tCodSeccion=cata-eve-det&eCodEvento=<?=$rEvento{'eCodEvento'}?>"><?=$rEvento{'nombreCliente'}.' '.$rEvento{'apellidosCliente'}?></a>
                                                        </h5>
                                                        <span class="time"><?=$rEvento{'Estatus'}?></span>
                                                        <span class="time"><?=date('d/m/Y',strtotime($rEvento{'fhFechaEvento'}))?> (<?=date('H:i',strtotime($rEvento{'fhFechaEvento'}))?>)</span>
                                                        <button onclick="agregarTransaccion(<?=$rEvento{'eCodEvento'}?>)" data-toggle="modal" data-target="#myModal"><i class="fas fa-dollar-sign"></i></button>
                                                    </div>
                                                </div>
                                            <?
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<h2>No se han encontrado eventos en la fecha seleccionada</h2>';
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
    <?
    }
    ?>
                            </div>   
<!--Listado de eventos de ese día-->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
<script src="https://rawgithub.com/cletourneau/angular-bootstrap-datepicker/master/dist/angular-bootstrap-datepicker.js" charset="utf-8"></script>
<script>



function obtenerFecha()
{
var fecha = $("#datepicker").datepicker( 'getDate' );
var fhFecha = new Date(fecha);

var mes = fhFecha.getMonth();
mes = mes+1;
document.getElementById('datepicker1').value = fhFecha;
/*document.getElementById('datepicker1').value = fhFecha.getDate()+'-'+mes+'-'+fhFecha.getFullYear();*/
   window.location="?tCodSeccion=inicio&fhFechaConsulta="+document.getElementById('datepicker1').value;
}
    
    $('#datepicker').datepicker();
</script>