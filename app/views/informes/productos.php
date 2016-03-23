<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stock</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Busqueda
    </div>
        <?=form_open("informes/productos",array('class'=>'form-horizontal'))?>
            <div class="form-group">
                <label for="txtFechaInicio" class="control-label col-sm-2">Fecha Inicio</label>
                <div class="controls col-sm-4">
                    <input type="date" name="txtFechaInicio" id="txtFechaInicio" class="form-control" value="<?=set_value("txtFechaInicio")?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="txtFechaFin" class="control-label col-sm-2" >Fecha Fin</label>
                <div class="controls col-sm-4">
                    <input type="date" name="txtFechaFin" id="txtFechaFin" class="form-control" value="<?=set_value("txtFechaFin")?>">
                </div>
            </div>
            <button type='submit' class="btn btn-outline btn-primary btn-lg">Filtrar Fechas</button>
            
        </form>
    </div>
<div class="panel panel-default">
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-ventas">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>N&AElig; Venta</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Cliente</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php
                        $i=0;
                        if($listado!=FALSE){
                        foreach ($listado as $value): 

                        ?>

                    <tr>
                            <td><?=$value['CodigoProducto']?></td>
                            <td><?=$value['DescripcionProducto']?></td>
                            <td><?=$value['idCuenta']?></td>
                            <td><?=$value['FechaingresoCuenta']?></td>
                            <td><?=$value['NombreEstadocuenta']?></td>
                            <td><?=$value['NombreCliente']." ".$value['ApellidoCliente']?></td>
                            <td><?=$value['CantidadDetallesolicitud']?></td>
                            <td><?=$value['PreciocatalogoDetallesolicitud']?></td>
                            <td><?=($value['CantidadDetallesolicitud']*$value['PreciocatalogoDetallesolicitud'])?></td>
                    </tr>
                    <?php endforeach;
                        }else{
                            ?>
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                           <td></td>
                            <td></td>
                            
                    </tr>
                    <tr><td colspan="9">Sin Datos</td></tr>
                    <?php
                            
                        }
?>
                </tbody>
            </table>            
</div>