<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Estado de Cuenta</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-info">
    <div class="panel-heading">
                         Cuenta
    </div>
    <div class="panel-body">
        
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Rut</strong></td>
                    <td><?=$cuenta['RutVendedor']?></td>
                    <td><strong>Nombre Vendedor</strong></td>
                    <td><?=$cuenta['NombreVendedor']." ".$cuenta['ApellidoVendedor']?></td>
                    <td><strong>Direccion de Despacho</strong></td>
                    <td><?=$cuenta['DireccionVendedor']?></td>
                </tr>
                <tr>
                    
                    <td><strong>Correo</strong></td>
                    <td><?=$cuenta['CorreoVendedor']?></td>
                    <td><strong>Fecha Emision</strong></td>
                    <td><?=$cuenta['FechaingresoCuenta']?></td>
                    <td><strong>Fecha de Pago</strong></td>
                    <td><?=$cuenta['FechapagoCuenta']?></td>
                </tr>
                <tr>
                    <td><strong>Estado Cuenta</strong></td>
                    <td><?=$cuenta['NombreEstadocuenta']?></td>
                    <td>
                        
                    </td>
                    <td colspan="3"></td>
                </tr>
            </table>
        </div>
    </div>
    
    <div class="panel panel-info">
                        <div class="panel-heading">
                            Detalle Estado Cuenta
                        </div>
        <div class="table-responsive">
            <table class="table table-striped  table-bordered table-hover table-condensed" width="100%" id="datatable-productos"> 
            <?php 
                $i=1;
                $totalGanancia=0;
                $totalRetencion=0;
                $totalaPagar=0;
                foreach ($detalle as $items): 
            ?>  
                <tr>
                    <th colspan="7"></th>
                </tr>
                <tr>
                    <th colspan="4">Detalle Pedido N° <?=$cuenta['RutVendedor']?>-<?=$items['idCuenta']?></th>
                    <th colspan="3">Fecha <?=$items['FechaingresoSolicitud']?></th>
                </tr>
                <tr>
                    <th colspan="7"></th>
                </tr>
                <tr>
                    <th>CODIGO PRODUCTO</th>
                    <th>NOMBRE</th>
                    <th>PRECIO CATALOGO</th>
                    <th>CANTIDAD</th>
                    <th>GANANCIA LIQUIDA</th>
                    <th>RETENCION</th>
                    <th>TOTAL A PAGAR</th>
                </tr>
                
            <?php
                    $this->load->model("solicitud_model");
                    $detalle_solicitud=$this->solicitud_model->get_detalle_solicitud($items["idSolicitud"]);
                    foreach($detalle_solicitud as $items_detalle ):
                    ?>
                <tr>
                    <td><?=$items_detalle['CodigocatalogoProducto']?></td>
                    <td><?=$items_detalle['DescripcionProducto']?></td>
                    <td><?=  number_format($items_detalle['PreciocatalogoDetallesolicitud'],0,",",".")?></td>
                    <td><?=number_format($items_detalle['CantidadDetallesolicitud'],0,",",".")?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10(($items_detalle['CantidadDetallesolicitud']*$items_detalle['GananciaDetallesolicitud'])),0,",",".")?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10(($items_detalle['CantidadDetallesolicitud']*$items_detalle['RetencionDetallesolicitud'])),0,",",".")?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10(($items_detalle['CantidadDetallesolicitud']*$items_detalle['ApagarDetallesolicitud'])),0,",",".")?></td>
                </tr>
                
                    <?php
                    $totalGanancia+=($items_detalle['CantidadDetallesolicitud']*$items_detalle['GananciaDetallesolicitud']);
                    $totalRetencion+=($items_detalle['CantidadDetallesolicitud']*$items_detalle['RetencionDetallesolicitud']);
                    $totalaPagar+=($items_detalle['CantidadDetallesolicitud']*$items_detalle['ApagarDetallesolicitud']);
                    endforeach;
                endforeach;
            ?> 
                <tr>
                    <th colspan="2"></th>
                    <th colspan="2">Totales Ciclo</th>
                    <th><?=number_format($this->crearproductos->redondear_a_10($totalGanancia),0,",",".")?></th>
                    <th><?=number_format($this->crearproductos->redondear_a_10($totalRetencion),0,",",".")?></th>
                    <th><?=number_format($this->crearproductos->redondear_a_10($totalaPagar),0,",",".")?></th>
                    
                </tr>
            </table>
        </div>
    </div>
    
    
</div>
