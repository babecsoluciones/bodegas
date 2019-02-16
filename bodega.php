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

$select = "SELECT be.*, cc.tNombres nombreCliente, cc.tApellidos apellidosCliente,
															su.tNombre as promotor, ce.tNombre Estatus FROM BitEventos be INNER JOIN CatClientes cc ON cc.eCodCliente = be.eCodCliente
															INNER JOIN CatEstatus ce ON ce.eCodEstatus = be.eCodEstatus
														LEFT JOIN SisUsuarios su ON su.eCodUsuario = be.eCodUsuario
                                                        WHERE
                                                        be.fhFechaEvento between $fhFechaInicio AND $fhFechaTermino".
                                                        " AND be.eCodEstatus<>4".
												        ($bAll ? "" : " AND cc.eCodUsuario = ".$_SESSION['sessionAdmin'][0]['eCodUsuario']).
														" ORDER BY be.fhFechaEvento DESC";
														
$rsEventos = mysql_query($select);
?>
<!--estilo-->
<style>
.bodega
    {
        color:#000000;
        background-color: darkgrey;
        padding:5px;
        border-radius: 5px;
    }
    .enlaceBodega
    {
        text-decoration: none;
        color: #666666;
    }
    .enlaceBodega:hover
    {
        text-decoration: none;
        color: #cccccc;
    }
</style>

<!--estilo-->
<div class="row">
<!--calendario-->
    <div class="col-lg-4" >
        <div class="au-card au-card--no-shadow au-card--no-pad m-b-40" id="datepicker" onclick="obtenerFecha()"></div>
        <center>
        <form id="Datos" method="post" action="<?=$_SERVER['PHP_SELF']?>?tCodSeccion=bodega">
    <input type="hidden" name="fhFechaConsulta" id="datepicker1">
    <input type="submit" class="btn btn-info" value="Consultar">
    </form>
        </center>
    </div>
<!--calendario-->
<!--Listado de eventos de ese día-->
<div class="col-lg-8">
                               
                                    <!--acordion-->
                                    <?
    $i = 0;
    for($b=0;$b<sizeof($lstTiposDocumentos);$b++)
    {
    
    $eCodTipoDocumento =   $lstTiposDocumentos[$b]['eCodTipoDocumento'];  
    $tNombre =  $lstTiposDocumentos[$b]['tNombre'];    
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
    if(mysql_num_rows($rsEventos))
    {
       
        while($rEvento = mysql_fetch_array($rsEventos))
        {
    ?>
    <h3><?=$tNombre?></h3>
                                    <div class="panel-group" id="accordion">
    <div class="panel panel-default">
      <div class="panel-heading bodega">
        <h4 class="panel-title">
          <a data-toggle="collapse" class="enlaceBodega" data-parent="#accordion" href="#collapse<?=$i?>"><b><?=sprintf("%07d",$rEvento{'eCodEvento'})?></b> | <?=$rEvento{'nombreCliente'}.' '.$rEvento{'apellidosCliente'}?> | <?=date('d/m/Y H:i',strtotime($rEvento{'fhFechaEvento'}))?></a>
        </h4>
      </div>
      <div id="collapse<?=$i?>" class="panel-collapse collapse in">
        <div class="panel-body">
          
            <?
            $select = "	SELECT DISTINCT
															cs.tNombre,
                                                            cs.dPrecioVenta,
                                                            rep.eCodServicio,
                                                            rep.eCantidad,
                                                            cs.eCodServicio,
                                                            rep.dMonto
                                                        FROM CatServicios cs
                                                        INNER JOIN RelEventosPaquetes rep ON rep.eCodServicio = cs.eCodServicio and rep.eCodTipo = 1
                                                        WHERE rep.eCodEvento = ".$rEvento['eCodEvento'];
            
											$rsPublicaciones = mysql_query($select);
                                            $dTotalEvento = 0;
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
                                                ?>
            <?=($rPublicacion{'tNombre'})?><br><i>
                    <?
                        $select = "SELECT ci.tNombre, rsi.ePiezas FROM CatInventario ci INNER JOIN RelServiciosInventario rsi ON rsi.eCodInventario=ci.eCodInventario WHERE rsi.eCodServicio = ".$rPublicacion{'eCodServicio'};
                                                $rsDetalle = mysql_query($select);
                                                while($rDetalle = mysql_fetch_array($rsDetalle))
                                                {
                                                    ?>
                    ·x<?=$rDetalle{'ePiezas'}?> - <?=($rDetalle{'tNombre'})?>, 
                    <?
                                                }
                    ?></i><br>
            <?
                                            }
                                            
                                            $select = "	SELECT DISTINCT
															cs.tNombre,
                                                            cs.dPrecioVenta,
                                                            rep.eCodServicio,
                                                            rep.eCantidad,
                                                            rep.dMonto
                                                        FROM CatInventario cs
                                                        INNER JOIN RelEventosPaquetes rep ON rep.eCodServicio = cs.eCodInventario and rep.eCodTipo = 2
                                                        WHERE rep.eCodEvento = ".$rEvento['eCodEvento'];
											$rsPublicaciones = mysql_query($select);
                                            
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
                                             ?><?=($rPublicacion{'tNombre'})?><br><?   
                                            }
            ?>
          
          </div>
      </div>
    </div>
    
    
  </div> 
                                    <?
            $i++;
        }
    }
              else
                  { ?><h2>Sin <?=$tNombre?> registrados para la fecha seleccionada</h2><? }?>                  
                                    <!--acordion-->
                              <? } ?> 
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