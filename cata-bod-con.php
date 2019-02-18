<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();
$bAll = $clSistema->validarPermiso($_GET['tCodSeccion']);
?>
<script>
function detalles(eCodBodega)
    {
        window.location="?tCodSeccion=cata-bod-det&eCodBodega="+eCodBodega;
    }
</script>
<div class="row">
	<div class="col-lg-12">
        <? if($clSistema->validarEnlace('cata-bod-reg')) { ?>
	<button type="button" class="btn btn-primary" onclick="window.location='?tCodSeccion=cata-bod-reg'"><i class="fa fa-plus"></i> Nueva Bodega</button>
        <? } ?>
	</div>
</div>
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Bodegas</h2>
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
                                                <th>C&oacute;digo</th>
                                                <th>Nombre</th>
                                                <th>Ubicaci&oacute;n</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$select = "	SELECT 
															*
														FROM
															CatBodegas cc
														 ORDER BY cc.eCodBodega ASC";
											$rsPublicaciones = mysql_query($select);
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
                                                $detalle = file_exists("cata-bod-det.php") ? '' : 'disabled="disabled" style="display:none;"';
                                                $menuEmergente = '<div class="dropdown">
                                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                            '.sprintf("%07d",$rPublicacion{'eCodBodega'}).'
                                                                            </button>
                                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                            <a class="dropdown-item" href="?tCodSeccion=cata-bod-det&eCodBodega='.$rPublicacion{'eCodBodega'}.'" '.$detalle.'><i class="fa fa-eye"></i> Detalles</a>
                                                                            <a class="dropdown-item" href="?tCodSeccion=cata-bod-reg&eCodBodega='.$rPublicacion{'eCodBodega'}.'"><i class="fa fa-pencil-square-o"></i> Editar</a>
                                                                        </div>
                                                                   </div>';
                                                
												?>
											<tr>
                                                <td><?=$menuEmergente?></td>
												<td><?=utf8_decode($rPublicacion{'tNombre'})?></td>
												<td><?=utf8_decode(base64_decode($rPublicacion{'tUbicacion'}))?></td>
                                            </tr>
											<?
											}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>