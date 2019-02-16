<?php
require_once("cnx/swgc-mysql.php");
require_once("cls/cls-sistema.php");
$clSistema = new clSis();
session_start();

$select = "SELECT be.*, (cc.tNombres + ' ' + cc.tApellidos) as tNombre FROM BitEventos be INNER JOIN CatClientes cc ON cc.eCodCliente = be.eCodCliente WHERE be.eCodEvento = ".$_GET['eCodEvento'];
$rsPublicacion = mysql_query($select);
$rPublicacion = mysql_fetch_array($rsPublicacion);

$bIVA = $rPublicacion{'bIVA'};

//clientes
$select = "	SELECT 
															cc.*, 
											
															su.tNombre as promotor
														FROM
															CatClientes cc
														
														LEFT JOIN SisUsuarios su ON su.eCodUsuario = cc.eCodUsuario
                                                        ORDER BY cc.eCodCliente ASC";
$rsClientes = mysql_query($select);

?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
    
    <title>Detalle del Evento</title>
    
    <style>
    .invoice-box {
        max-width: 800px;
        width:700px;
        height:95vh;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
    }
    
    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }
    
    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }
    
    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }
    
    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }
    
    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }
    
    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }
    
    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }
    
    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }
    
    .invoice-box table tr.item.last td {
        border-bottom: none;
    }
    
    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }
    
    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }
        
        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }
    
    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }
    
    .rtl table {
        text-align: right;
    }
    
    .rtl table tr td:nth-child(2) {
        text-align: left;
    }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="../images/icon/logo.png" style="width:120%; max-width:120px;">
                            </td>
                            
                            <td>
                                Evento # <?=sprintf("%07d",$_GET['eCodEvento'])?><br>
                                Fecha: <?=date('d/m/Y',strtotime($rPublicacion{'fhFechaEvento'}))?><br>
                                Hora de Montaje: <?=date('H:i',strtotime($rPublicacion{'fhFechaEvento'}))?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                 <?
     while($rPaquete = mysql_fetch_array($rsClientes))
{
         ?>
                  <?=($rPublicacion{'eCodCliente'}==$rPaquete{'eCodCliente'}) ? $rPaquete{'tNombres'}.' '.$rPaquete{'tApellidos'}.' <br>'.$rPaquete{'tCorreo'}.'<br>Tel.'.$rPaquete{'tTelefonoFijo'}.'<br>Cel.'.$rPaquete{'tTelefonoMovil'} : ''?>
                  <?
}
    ?>
                            </td>
                            
                            <td>
                                <?=nl2br(base64_decode(utf8_decode($rPublicacion{'tDireccion'})))?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            
            
            <tr class="heading">
                <td>
                    Descripci&oacute;n
                </td>
                
                <td>
                    Precio
                </td>
            </tr>
            
            
											<?
                                            $i = 0;
											$select = "	SELECT DISTINCT
															cs.tNombre,
                                                            cs.dPrecioVenta,
                                                            rep.eCodServicio,
                                                            rep.eCantidad,
                                                            cs.eCodServicio,
                                                            rep.dMonto
                                                        FROM CatServicios cs
                                                        INNER JOIN RelEventosPaquetes rep ON rep.eCodServicio = cs.eCodServicio and rep.eCodTipo = 1
                                                        WHERE rep.eCodEvento = ".$_GET['eCodEvento'];
											$rsPublicaciones = mysql_query($select);
                                            $dTotalEvento = 0;
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												?>
											<tr class="item">
                <td>
                    <?=utf8_decode($rPublicacion{'tNombre'})?><br><i>
                    <?
                        $select = "SELECT ci.tNombre, rsi.ePiezas FROM CatInventario ci INNER JOIN RelServiciosInventario rsi ON rsi.eCodInventario=ci.eCodInventario WHERE rsi.eCodServicio = ".$rPublicacion{'eCodServicio'};
                                                $rsDetalle = mysql_query($select);
                                                while($rDetalle = mysql_fetch_array($rsDetalle))
                                                {
                                                    ?>
                    x<?=$rDetalle{'ePiezas'}?> - <?=($rDetalle{'tNombre'})?>, 
                    <?
                                                }
                    ?></i>
                </td>
                
                <td>
                    $<?=number_format($rPublicacion{'dMonto'},2)?>
                </td>
            </tr>
											<?
											$i++;
                                                $dTotalEvento = $dTotalEvento + ($rPublicacion{'dMonto'});
											}
                                            $select = "	SELECT DISTINCT
															cs.tNombre,
                                                            cs.dPrecioVenta,
                                                            rep.eCodServicio,
                                                            rep.eCantidad,
                                                            rep.dMonto
                                                        FROM CatInventario cs
                                                        INNER JOIN RelEventosPaquetes rep ON rep.eCodServicio = cs.eCodInventario and rep.eCodTipo = 2
                                                        WHERE rep.eCodEvento = ".$_GET['eCodEvento'];
											$rsPublicaciones = mysql_query($select);
                                            
											while($rPublicacion = mysql_fetch_array($rsPublicaciones))
											{
												?>
											<tr class="item">
                <td>
                    <?=utf8_decode($rPublicacion{'tNombre'})?>
                </td>
                
                <td>
                    $<?=number_format($rPublicacion{'dMonto'},2)?>
                </td>
            </tr>
											<?
											$i++;
                                                $dTotalEvento = $dTotalEvento + ($rPublicacion{'dMonto'});
											}
											?>
            
            
            
            <tr class="total">
                <td></td>
                
                <td>
                   <?=$bIVA ? "Subtotal" : "Total"?>: $<?=number_format($dTotalEvento,2)?>
                </td>
            </tr>
            <?
    if($bIVA)
    {
        $dIVA = number_format(($dTotalEvento*0.16),2);
        
        $dTotal = number_format(($dTotalEvento*1.16),2);
    ?>
            <tr class="total">
                <td></td>
                
                <td>
                   I.V.A.: $<?=$dIVA?>
                </td>
            </tr>
            <tr class="total">
                <td></td>
                
                <td>
                   Total: $<?=$dTotal?>
                </td>
            </tr>
            <? } ?>
        </table>
    </div>
</body>
</html>

