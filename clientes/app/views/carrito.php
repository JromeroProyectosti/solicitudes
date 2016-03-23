<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Productos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     <div class="panel panel-body">
     <?php
    echo form_open("ingresar_solicitud",array('class'=>'form-horizontal'));

    ?>
    <input type="submit" value="Ingresar Solicitud" class="btn btn-primary">
    
    <p></p>
    
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Cod. Cat.</th>
                    <th>Descripcion</th>
                
                    <th>Precio Catalogo</th>
                    <th>Comision</th>
                    <th>Cantidad</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                        $i=0;
                        if($this->cart->total_items()>0){
                        foreach ($this->cart->contents() as $value): 

                        ?>

                    <tr>
                            <td><?=$value['id']?></td>
                            <td><?=$value['catalogo']?></td>
                            <td><?=$value['name']?></td>
                            <td>$<?=number_format($value['price'],0,",",".")?></td>
                            <td>$<?=number_format($value['comision'],0,",",".")?></td>
                            <td>
                                <input type="hidden" value="<?=$value['idProducto']?>"  name="hdIdProducto[]">
                                <input type="text" value="<?=$value['qty']?>"  name="txtCantidad[]">
                            </td>
                            <td><a href="<?=base_url()?>eliminar_producto/<?=$value['rowid']?>" >
                                    <button type="button" class="btn btn-default" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button></a></td>
                           
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
                            
                    </tr>
                    <tr><td colspan="9">Sin Datos</td></tr>
                    <?php
                            
                        }
?>
                </tbody>
            </table>            
        </div>
    </form>
     </div>
</div>