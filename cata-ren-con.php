<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();
$bAll = $clSistema->validarPermiso($_GET['tCodSeccion']);

if($_GET['eCodEvento'])
{
    mysql_query("UPDATE BitEventos SET eCodEstatus = ".$_GET['eAccion']." WHERE eCodEvento =".$_GET['eCodEvento']);
    
        $fhFecha = "'".date('Y-m-d H:i:s')."'";
        $tDescripcion = "Se ha ".(($_POST['eAccion']==4) ? 'CANCELADO' : 'FINALIZADO')." la renta ".sprintf("%07d",$_GET['eCodEvento']);
        $tDescripcion = "'".$tDescripcion."'";
        $eCodUsuario = $_SESSION['sessionAdmin'][0]['eCodUsuario'];
        mysql_query("INSERT INTO SisLogs (eCodUsuario, fhFecha, tDescripcion) VALUES ($eCodUsuario, $fhFecha, $tDescripcion)");
    
    echo '<script>window.location="?tCodSeccion=cata-eve-con";</script>';
              
}

?>
<script>
function detalles(codigo)
    {
        window.location="?tCodSeccion=cata-eve-det&eCodEvento="+codigo;
    }
function cancelar(codigo)
    {
        window.location="?tCodSeccion=cata-eve-con&eAccion=4&eCodEvento="+codigo;
    }
function finalizar(codigo)
    {
        window.location="?tCodSeccion=cata-eve-con&eAccion=8&eCodEvento="+codigo;
    }
function ruta(codigo)
    {
        window.location="?tCodSeccion=cata-eve-det&eCodEvento="+codigo+"&bRuta=1";
    }
</script>
<div class="row">
	<div class="col-lg-12">
        <? if($clSistema->validarEnlace('oper-eve-reg')) { ?>
	<button type="button" class="btn btn-primary" onclick="window.location='?tCodSeccion=oper-ren-reg'"><i class="fa fa-plus"></i> Nueva Renta </button>
        <? } ?>
	</div>
</div>
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Rentas</h2>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                       <input class="au-input" id='search' placeholder='Búsqueda rápida...'> 
                                    </div>
                                </div>
                                <div class="table-responsive table--no-card m-b-40" style="max-height:500px; overflow-y: scroll;">
                                    <table class="table table-borderless table-striped table-earning" id="table">
                                        <thead>
                                            
                                            <tr>
                                                <th class="text-right">E</th>
												<th class="text-right">Cliente</th>
												<th class="text-right">Fecha Evento (Hora de montaje)</th>
												<th class="text-right">Promotor</th>
                                                <th class="text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$select = "SELECT be.*, cc.tNombres nombreCliente, cc.tApellidos apellidosCliente,
															su.tNombre as promotor, ce.tIcono FROM BitEventos be INNER JOIN CatClientes cc ON cc.eCodCliente = be.eCodCliente
															INNER JOIN CatEstatus ce ON ce.eCodEstatus = be.eCodEstatus
														LEFT JOIN SisUsuarios su ON su.eCodUsuario = be.eCodUsuario".
                                                " WHERE be.eCodEstatus<>4  AND be.eCodTipoDocumento=2".
												($bAll ? "" : " AND cc.eCodUsuario = ".$_SESSION['sessionAdmin'][0]['eCodUsuario']).
														" ORDER BY be.fhFechaEvento DESC";
											
											
											$rsPublicaciones = mysql_query($select);
											
//echo $select;

while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
    $edicion = ($clSistema->validarEnlace('oper-eve-reg')) ? '' : 'style="display:none;" disabled';
    $detalle = ($clSistema->validarEnlace('cata-eve-det')) ? '' : 'style="display:none;" disabled';
    $ruta    = ($_SESSION['sessionAdmin'][0]['bAll'])       ? '' : 'style="display:none;" disabled';
    $bloqueo = $bAll ? '' : 'style="display:none;" disabled';
												?>
											<tr>
                                                <td align="center"><i class="<?=$rPublicacion{'tIcono'}?>"></i></td>
												<td><?=utf8_decode($rPublicacion{'nombreCliente'}.' '.$rPublicacion{'apellidosCliente'})?></td>
												<td><?=date('d/m/Y H:i', strtotime($rPublicacion{'fhFechaEvento'}))?></td>
												<td><?=utf8_decode($rPublicacion{'promotor'})?></td>
                                                <td class="text-right"> 
                                                    <button onclick="agregarTransaccion(<?=$rPublicacion{'eCodEvento'}?>)" data-toggle="modal" data-target="#myModal"><i class="fas fa-dollar-sign"></i></button>
													<button onclick="detalles(<?=$rPublicacion{'eCodEvento'}?>)" <?=$detalle?>><i class="fa fa-eye"></i></button> 
													<button onclick="window.location='?tCodSeccion=oper-eve-reg&eCodEvento=<?=$rPublicacion{'eCodEvento'}?>'" <?=$edicion?>><i class="fa fa-pencil-square-o"></i></button>
                                                    <button onclick="cancelar(<?=$rPublicacion{'eCodEvento'}?>)" <?=$bloqueo?>><i class="far fa-trash-alt"></i></button>
                                                    <button onclick="finalizar(<?=$rPublicacion{'eCodEvento'}?>)" <?=$bloqueo?>><i class="fas fa-check-double"></i></button>
                                                    <button onclick="ruta(<?=$rPublicacion{'eCodEvento'}?>)" <?=$bloqueo?>><i class="fas fa-truck"></i></button>
												</td>
                                            </tr>
											<?
											}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>