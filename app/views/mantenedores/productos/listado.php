<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Productos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     <?php
    echo form_open("crear_producto",array('class'=>'form-horizontal'));

    ?>
    <input type="submit" value="Nuevo Producto" class="btn btn-primary">
    </form>
    <p></p>
    
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">
            <thead>
                <tr>
                    
                    <th>Cod. Prod.</th>
                    <th>Descripcion</th>
                    <th>Producto</th>
                    <th>Costo</th>
                    <th>Precio</th>
                    <th>Modificar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i=0;
                if($listado!=FALSE){
                    foreach ($listado as $value): 
                    $this->load->model("productos_model");
                    $categoria = $this->productos_model->get_listado_categorias($value['idCategoria']);
                    ?>

                <tr>
                    <td><?=$value['CodigoProducto']?></td>
                    <td><?=$value['DescripcionProducto']?></td>
                    <td><?=$categoria['NombreCategoria']?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10($value['PreciocompraProducto']),0,",",".")?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10($value['PrecioventaProducto']),0,",",".")?></td>
                   
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
                            
                    </tr>
                    <tr><td colspan="9">Sin Datos</td></tr>
                    <?php
                            
                        }
?>
                </tbody>
            </table>            
</div>