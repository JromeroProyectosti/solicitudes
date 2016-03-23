<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Venta N&deg; <?=$cuenta['idCuenta']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-info">
    <div class="panel-heading">
                         Cliente
    </div>
    <div class="panel-body">
        <?php
        echo form_open("cuentas/modificar_venta");?>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Rut</strong></td>
                    <td><?=$cuenta['RutCliente']?></td>
                    <td><strong>Nombre Cliente</strong></td>
                    <td><?=$cuenta['NombreCliente']." ".$cuenta['ApellidoCliente']?></td>
                    <td><strong>Direccion de Despacho</strong></td>
                    <td><?=$cuenta['DireccionCliente']?></td>
                </tr>
                <tr>
                    
                    <td><strong>Correo</strong></td>
                    <td><?=$cuenta['CorreoCliente']?></td>
                    <td><strong>Fecha Emision</strong></td>
                    <td><?=$cuenta['FechaingresoCuenta']?></td>
                    <td><strong>Fecha de Pago</strong></td>
                    <td><input type="text" name="txtFecha" id="txtFecha" ></td>
                </tr>
                <tr>
                    <td><strong>Estado Cuenta</strong></td>
                    <td>
                        <select name="cboEstado"  class="form-control">
                    <?php
                    foreach($estado_cuenta as $item):
                    ?>
                        
                        <option value='<?=$item['idEstadocuenta']?>'
                    <?php
                    if($item['idEstadocuenta']==$cuenta['idEstadocuenta']) echo "selected";
                    ?>
                                ><?=$item['NombreEstadocuenta']?></option>
                               
                    <?php
                    endforeach;
                    ?>
                    </select>
                    </td>
                    
                    <td>
                        
                        <input type="hidden" value="<?=$cuenta['idCuenta']?>" name="hdCuenta">
                        <button class="btn btn-default">Cambiar Estado</button>
                        
                    </td>
                    <td colspan="3"></td>
                </tr>
            </table>
        </div>
        </form>
    </div>
    
    <div class="panel panel-info">
                        <div class="panel-heading">
                            Venta N&deg; <?=$cuenta['idCuenta']?>
                        </div>
        <div class="table-responsive">
            <table class="table table-striped  table-bordered table-hover table-condensed" width="100%" id="datatable-productos"> 
            <?php 
                $i=1;
                $totalGanancia=0;
                $totalRetencion=0;
                $totalaPagar=0;
                $CI=&get_instance();
                $CI->load->model("solicitud_model");
                foreach ($detalle as $items): 
            ?>  
                <tr>
                    <th colspan="7"></th>
                </tr>
                <tr>
                    <th colspan="4">Detalle Solicitud N&deg; <?=$items['idSolicitud']?></th>
                    <th colspan="3">Fecha <?=$items['FechaingresoSolicitud']?></th>
                </tr>
                <tr>
                    <th colspan="7"></th>
                </tr>
                <tr>
                    <th>CODIGO PRODUCTO</th>
                    <th>NOMBRE</th>
                    <th>PRECIO </th>
                    <th>CANTIDAD</th>
                    
                    <th>TOTAL A PAGAR</th>
                </tr>
                
            <?php
                    
                    $detalle_solicitud=$CI->solicitud_model->get_detalle_solicitud($items["idSolicitud"]);
                    foreach($detalle_solicitud as $items_detalle ):
                    ?>
                <tr>
                    <td><?=$items_detalle['CodigoProducto']?></td>
                    <td><?=$items_detalle['DescripcionProducto']?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10($items_detalle['PreciocatalogoDetallesolicitud']),0,",",".")?></td>
                    <td><?=number_format($items_detalle['CantidadDetallesolicitud'],0,",",".")?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10($items_detalle['CantidadDetallesolicitud']*$items_detalle['PreciocatalogoDetallesolicitud']),0,",",".")?></td>
                </tr>
                
                    <?php
                    $totalGanancia+=($items_detalle['CantidadDetallesolicitud']*$items_detalle['GananciaDetallesolicitud']);
                    $totalRetencion+=($items_detalle['CantidadDetallesolicitud']*$items_detalle['RetencionDetallesolicitud']);
                    $totalaPagar+=($items_detalle['CantidadDetallesolicitud']*$items_detalle['PreciocatalogoDetallesolicitud']);
                    endforeach;
                endforeach;
            ?> 
                <tr>
                    <th colspan="2"></th>
                    <th colspan="2">Total Venta</th>
                    <th><?=number_format($this->crearproductos->redondear_a_10($totalaPagar),0,",",".")?></th>
                    <th colspan="2"></th>
                </tr>
            </table>
        </div>
    </div>
    
    
</div>
<script>

    document.getElementById("txtFecha").defaultValue = "<?=$cuenta['FechapagoCuenta']?>";

</script>