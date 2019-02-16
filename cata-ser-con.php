<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();

?>
 
<script>
function detalles(eCodCliente)
    {
        window.location="?tCodSeccion=cata-ser-det&eCodServicio="+eCodCliente;
    }
</script>
<div class="row">
	<div class="col-lg-12">
        <? if($clSistema->validarEnlace('cata-ser-reg')) { ?>
	<button type="button" class="btn btn-primary" onclick="window.location='?tCodSeccion=cata-ser-reg'"><i class="fa fa-plus"></i> Nuevo Paquete</button>
        <? } ?>
	</div>
</div>
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Paquetes</h2>
                                
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        
                                        
                                    </div>
                                    <div class="table-data__tool-right">
                                       <input class="au-input" id='search' placeholder='Búsqueda rápida...'> 
                                    </div>
                                </div>
                                <div class="table table-responsive table--no-card m-b-40" style="max-height:500px; overflow-y: scroll;">
                                    <table class="table table-responsive table-top-campaign" id="table">
                                        <thead>
                                            
                                            <tr>
												
                                                <th>Nombre</th>
                                                <th>Descripci&oacute;n</th>
                                                <th class="text-right">Precio</th>
                                                <th class="text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$select = "	SELECT 
															*
														FROM
															CatServicios
														ORDER BY tNombre ASC";
											$rsPublicaciones = mysql_query($select);
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												?>
											<tr>
                                                
												<td><?=utf8_decode($rPublicacion{'tNombre'})?></td>
												<td><?=substr(utf8_decode($rPublicacion{'tDescripcion'}),0,50)?>...</td>
												<td>$<?=number_format($rPublicacion{'dPrecioVenta'},2)?></td>
                                                <td class="text-right"> 
													<button onclick="detalles(<?=$rPublicacion{'eCodServicio'}?>)"><i class="fa fa-eye"></i></button> 
													<button onclick="window.location='?tCodSeccion=cata-ser-reg&eCodServicio=<?=$rPublicacion{'eCodServicio'}?>'"><i class="fa fa-pencil-square-o"></i></button>
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