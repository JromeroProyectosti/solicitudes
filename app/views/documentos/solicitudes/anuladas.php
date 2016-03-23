<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Solicitud N&ordm; <?=$solicitud['idSolicitud']?></h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     
    <div class="panel-body">
        <div class="table-responsive">
            <?=form_open("modificar_solicitud/".$solicitud['idSolicitud'])?>
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
                    <td><?php
                        foreach($comuna as $item_comuna){
                           
                         if($solicitud['IdComuna']==$item_comuna['IdComuna']) echo $item_comuna["NombreComuna"];   
                        }
                    ?></td>
                </tr>
                <tr>
                    <td><strong>Fecha Solicitud</strong></td>
                    <td><?=$solicitud['FechaingresoSolicitud']?></td>
                    <td><strong>Numero Solicitud</strong></td>
                    <td><?=$solicitud['idSolicitud']?></td>
                </tr>
                <tr>
                    <td><strong>Estado Solicitud</strong></td>
                    <td>
                        <select name="cboEstado"  class="form-control">
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
                        <button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Modificar</button>
                        
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
                <th>Codigo Catalogo</th>
                <th>Descripcion</th>
                <th>Costo</th>
                <th>Precio Catalogo</th>
                <th>Iva</th>
                <th>Neto</th>
                <th>Comision(30%)</th>
                <th>Retencion(10%)</th>
                <th>A Pagar</th>
                <th>Ganancia</th>
                <th>Utilidad Empresa</th>
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
            <td><?=$items['CantidadDetallesolicitud']?>
                <td><?=$items['CodigoProducto']?></td>
                <td><?=$items['CodigocatalogoProducto']?></td>
                <td><?=$items['DescripcionProducto']?></td>
                
                <td><?=number_format($this->crearproductos->redondear_a_10($items['PreciocatalogoDetallesolicitud']),0,",",".")?></td>
                <td><?=number_format($this->crearproductos->redondear_a_10($items['IvaProducto']),0,",",".")?></td>
                <td><?=number_format($this->crearproductos->redondear_a_10($items['NetoProducto']),0,",",".")?></td>
                
                <td><?=number_format($this->crearproductos->redondear_a_10($items['ApagarDetallesolicitud']),0,",",".")?></td>
                <td><?=number_format($this->crearproductos->redondear_a_10($items['GananciaDetallesolicitud']),0,",",".")?></td>
                
            </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
       
    </div>
</div>