<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Solicitud N&ordm; <?=$solicitud['idSolicitud']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     
    <div class="panel-body">
        <div class="table-responsive">
            <?=form_open("modificar_despachadas/".$solicitud['idSolicitud'])?>
            <table class="table table-bordered">
                <tr>
                    <td><strong>Rut Cliente</strong></td>
                    <td><?=$solicitud['RutCliente']?></td>
                    <td><strong>Nombre Cliente</strong></td>
                    <td><?=$solicitud['NombreCliente']?></td>
                </tr>
                <tr>
                    <td><strong>Estado Cliente</strong></td>
                    <td><?=$solicitud['NombreEstadocliente']?></td>
                    <td><strong>Comuna</strong></td>
                    <td> <?php
                        foreach($comuna as $item_comuna){
                           
                         if($solicitud['IdComuna']==$item_comuna['IdComuna']) echo $item_comuna["NombreComuna"];   
                        }
                    ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha Solicitud</strong></td>
                    <td><?=$solicitud['FechaingresoSolicitud']?></td>
                    <td><strong>Direcci&oacute;n</strong></td>
                    <td><?=$solicitud['DireccionCliente']?></td>
                </tr>
                <tr>
                    <td><strong>Estado Solicitud</strong></td>
                    <td>
                        <select name="cboEstado"  class="form-control" disabled>
                    <?php
                    foreach($estado as $item):
                    ?>
                        
                        <option value='<?=$item['idEstadosolicitud']?>'
                    <?php
                    if($item['idEstadosolicitud']==$solicitud['idEstadosolicitud']) echo "selected";
                    ?>
                                ><?=$item['NombreEstadosolicitud']?></option>
                               
                    <?php
                    endforeach;
                    ?>
                    </select>
                    </td>
                    <td colspan="2">
                        
                    </td>
                </tr>
                <tr>
                    <td><strong>Forma de Envio</strong></td>
                    <td>
                       <select name="cboFormaenvio">
                            <?php
                            foreach($formaenvio as $options):
                            ?>
                            <option value="<?=$options['idFormaenvio']?>" 
                            <?php
                            if($solicitud['idFormaenvio']==$options['idFormaenvio']) echo "selected";
                            ?>
                                 ><?=$options['NombreFormaenvio']?></option>
                            
                            <?php
                            endforeach;
                            ?>
                        </select>
                        
                    </td>
                    <td colspan="2">
                        
                    </td>
                </tr>
                <tr>
                    <td><strong>Numero de Envio</strong></td>
                    <td>
                       
                        <label class="control-label" ><?=$solicitud['NumeroenvioSolicitud']?></label>
                    </td>
                    <td colspan="2">
                        <input type="hidden" name="hdAccion" value="4">
                        
                        <button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Pagada</button>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
    <div class="table-responsive">
                        
        <table class="table table-striped  table-bordered table-hover table-condensed" width="100%" id="datatable-productos">
            <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Codigo</th>
                   
                    <th>Descripci&oacute;n</th>
                    <th>Neto</th>
                    <th>Iva</th>
                    <th>Precio</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            $i=1;
            foreach ($detalle as $items): ?>

            <?php 
            $i++;
            ?>
            
            <tr>
                <td><input type="text" size="5" name="txtCantidad[]" value="<?=$items['CantidadDetallesolicitud']?>"></td>
                <td>
                    <?=$items['CodigoProducto']?>
                    <input type="hidden" name="hdIdDetalle[]" value="<?=$items['idDetallesolicitud']?>">
                    <input type="hidden" name="hdIdProducto[]" value="<?=$items['idproductos']?>">

                </td>
                
                <td><?=$items['DescripcionProducto']?></td>
                <td><?=number_format($this->crearproductos->redondear_a_10($items['NetoProducto']),0,",",".")?></td>
                <td><?=number_format($this->crearproductos->redondear_a_10($items['IvaProducto']),0,",",".")?></td>
                <td><input type="text" size="5" name="txtPrecioCatalogo[]" value="<?=number_format($this->crearproductos->redondear_a_10($items['PreciocatalogoDetallesolicitud']),0,",",".")?>"></td>
                <td><?=number_format($this->crearproductos->redondear_a_10($items['PreciocatalogoDetallesolicitud'])*$items['CantidadDetallesolicitud'],0,",",".")?>
                
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="6"></td>
                <td><div align="left"><h4>TOTAL</h4></div></td>
                <td>
                    <h4><?=number_format($this->crearproductos->redondear_a_10($solicitud["TotalapagarSolicitud"]),0,",",".")?></h4>
                </td>
            </tr>
            </tbody>
            </table>
       
    </div>
</div>