<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
require_once("lstTiposDocumentos.php");
$clSistema = new clSis();
session_start();

$bAll = $clSistema->validarPermiso($_GET['tCodSeccion']);
?>

<div class="row">

<!--mostramos por tipo de inventario-->
<?
    $select = "SELECT * FROM CatTiposInventario ORDER BY tNombre ASC";
    $rsTiposInventario = mysql_query($select);
    while($rTipoInventario = mysql_fetch_array($rsTiposInventario))
    {
        $contador = mysql_num_rows(mysql_query("SELECT COUNT(*) FROM CatInventario WHERE eCodTipoInventario = ".$rTipoInventario{'eCodTipoInventario'}));
        ?>
    <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number"><?=$contador?></h2>
                                    <span class="desc"><?=$rTipoInventario{'tNombre'}?></span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-calendar-note"></i>
                                    </div>
                                </div>
                            </div>
    <?
    }
    ?>
<!--mostramos por tipo de inventario-->

</div>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
<script src="https://rawgithub.com/cletourneau/angular-bootstrap-datepicker/master/dist/angular-bootstrap-datepicker.js" charset="utf-8"></script>
