<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Compras</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     <?php
    echo form_open("ingresar_factura",array('class'=>'form-horizontal'));

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
                    <th>Fecha Factura</th>
                    <th>Fecha Ingreso</th>
                    <th>Usuario</th>
                    <th>Monto</th>
                    <th>Estado</th>
                    <th>Ver Documento</th>
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
                            <td><?=$value['NumeroCompra']?></td>
                            <td><?=$value['NombreProveedor']?></td>
                            <td><?=$value['FecharegistroCompra']?></td>
                            <td><?=$value['FechaingresoCompra']?></td>
                            <td><?=$value['NombreUsuario']." ".$value['ApellidoUsuario']?></td>
                            <td><?=$this->crearproductos->redondear_a_10($value['Monto'])?></td>
                            <td><?=$value['NombreEstadoCompra']?></td>
                            <td><a href="<?=base_url()?>detalle_compra/<?=$value['IdCompra']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" ></span></button></a></td>
                            
                            <td>
                            
                                <a href="<?=base_url()?>ingresar_factura/<?=$value['IdCompra']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-edit" ></span></button></a>
                            
                            </td>
                            <td><a href="<?=base_url()?>eliminar_compra/<?=$value['IdCompra']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                           
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