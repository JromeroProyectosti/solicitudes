<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Compras</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     <?php
    echo form_open("crear_compra",array('class'=>'form-horizontal'));

    ?>
    <input type="submit" value="Nueva Compra" class="btn btn-primary">
    </form>
    <p></p>
    
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-compras">
            <thead>
                <tr>
                    <th>Numero</th>
                    <th>Proveedor</th>
                    <th>Fecha Ingreso</th>
                    <th>Precio Total</th>
                    <th>Precio Total</th>
                    <th>Precio Total</th>
                    <th>Detalle</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
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
                            <td><?=$value['CodigocatalogoProducto']?></td>
                            <td><?=$value['DescripcionProducto']?></td>
                            <td><?=$value['PreciocompraProducto']?></td>
                            <td><?=$value['PrecioventaProducto']?></td>
                            <td><?=$value['ApagarProducto']?></td>
                            <td><a href="<?=base_url()?>detalle_producto/<?=$value['idproductos']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" ></span></button></a></td>

                           <td><a href="<?=base_url()?>modificar_producto/<?=$value['idproductos']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-edit" ></span></button></a></td>
                            <td><a href="<?=base_url()?>eliminar_producto/<?=$value['idproductos']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                           
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
                    <?php
                 
                    }
                        ?>
                
            </tbody>
        </table>
    </div>

</div>