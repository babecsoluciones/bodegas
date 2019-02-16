<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();

?>
<div class="row">
	<div class="col-lg-12">
		<button type="button" class="btn btn-primary" onclick="window.location='?tCodSeccion=cata-usr-reg'"><i class="fa fa-plus"></i> Nuevo usuario</button>
	</div>
</div>
<div class="row">
                            <div class="col-lg-12">
                                <h2 class="title-1 m-b-25">Usuarios</h2>
                                <div class="table-responsive table--no-card m-b-40">
                                    <table class="table table-borderless table-striped table-earning">
                                        <thead>
                                            <tr>
												<th align="center">E</th>
                                                <th>Nombre</th>
                                                <th>Correo</th>
                                                <th>Perfil</th>
                                                <th class="text-right"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?
											$select = "	SELECT 
															cc.*, 
															ce.tCodEstatus as estatus,
															cp.tNombre as perfil
														FROM
															SisUsuarios cc
														LEFT JOIN CatEstatus ce ON cc.eCodEstatus = ce.eCodEstatus 
														LEFT JOIN SisPerfiles cp ON cp.eCodPerfil = cc.eCodPerfil".
												($_SESSION['sessionAdmin'][0]['bAll'] ? "" : " WHERE cc.eCodPerfil > 1").
														" ORDER BY cc.eCodUsuario ASC";
											
											$rsPublicaciones = mysql_query($select);
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												?>
											<tr>
                                                <td><?=utf8_decode($rPublicacion{'estatus'})?></td>
                                                <td><?=utf8_decode($rPublicacion{'tNombre'}.' '.$rPublicacion{'tApellidos'})?></td>
                                                <td><?=utf8_decode($rPublicacion{'tCorreo'})?></td>
                                                <td><?=utf8_decode($rPublicacion{'perfil'})?></td>
                                                <td class="text-right">
													<button type="button" class="btn btn-secondary mb-1" onclick="window.location='?tCodSeccion=cata-usr-reg&eCodUsuario=<?=$rPublicacion{'eCodUsuario'}?>'">
														<i class="fa fa-pencil-square-o"></i>
													</button>
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