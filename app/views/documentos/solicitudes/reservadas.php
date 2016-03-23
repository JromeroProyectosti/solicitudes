<div class="row">
    <div class="col-lg-12">
        
        <?=form_open("cli_solicitud/exportar_pdf")?>
                            <input type="hidden" name="hdAccion" value="3">
                            <input type="hidden" name="hdIdSolicitud" value="<?=$solicitud['idSolicitud']?>">

                           <h1 class="page-header">Solicitud N&ordm; <?=$solicitud['idSolicitud']?>   <button type='submit' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Exportar PDF</button></h1>
                        </form> 
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
   <?php 
   if(validation_errors()){
   ?>
    <div class="alert alert-success alert-dismissable">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <?php
       echo validation_errors();
   ?>
        
    </div>
    <?php
   }
   ?>
    <div class="panel-body">
        <div class="table-responsive">
            
                        <?=form_open("modificar_reservadas/".$solicitud['idSolicitud'])?>
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
                    <td>
                    <?php
                        foreach($comuna as $item_comuna){
                           
                         if($solicitud['IdComuna']==$item_comuna['IdComuna']) echo $item_comuna["NombreComuna"];   
                        }
                    ?>
                    
                    </td>
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
                    <td><strong>Vendedor</strong></td>
                    <td>
                       <?=$solicitud['NombreUsuario']?> <?=$solicitud['ApellidoUsuario']?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Forma envio</strong></td>
                    <td>
                        <select name="cboFormaenvio">
                            <?php
                            foreach($formaenvio as $options):
                            ?>
                            <option value="<?=$options['idFormaenvio']?>"><?=$options['NombreFormaenvio']?></option>
                            
                            <?php
                            endforeach;
                            ?>
                        </select>
                        
                    </td>
                    <td colspan="2">
                            <input type="hidden" name="hdAccion" value="3">
                            <button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Despachada</button>
                        
                       
                    </td>
                </tr>
                 <tr>
                    <td><strong>Numero de Envio</strong></td>
                    <td>
                       
                        <input type="text" class="form-control" name="txtNumeroenvio">
                    </td>
                    <td colspan="2">
                        
                    </td>
                </tr>
                
            </table>
            </form>
            
        </div>
    </div>
    <?=form_open("modificar_reservadas/".$solicitud['idSolicitud'])?>
        <div class="panel panel-default">
            <button type="submit" class="btn btn-primary btn-lg">Modificar Solicitud</button>
            
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
                    <th></th>
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
                <td><input type="text" size="5" name="txtCantidad[]" value="<?=$items['CantidadDetallesolicitud']?>" onkeyup="validar(<?=($items['StockProducto']-$items['ReservaProducto'])?>,this,<?=$items['CantidadDetallesolicitud']?>)"></td>
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
                <td>
                    <a href="<?=base_url()?>eliminar_detalle_solicitud/<?=$solicitud['idSolicitud']."/".$items['idDetallesolicitud']?>" ><button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                    </a>
                
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="5"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addProducto">
    Agregar Producto
</button></td></td>
                <td><div align="left"><h4>TOTAL</h4></div></td>
                <td>
                    <h4><?=number_format($this->crearproductos->redondear_a_10($solicitud["TotalapagarSolicitud"]),0,",",".")?></h4>
                </td>
            </tr>
     
                            
            </tbody>
            </table>

        </div>
    </form>
</div>


<div class="modal fade"  tabindex="-1" role="dialog" aria-labelldby="addProdcuto" id="addProducto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Agregar Producto</h4>
              </div>
            <div class="modal-body">
                <div class="table-responsive">

                    <table class="table table-striped  table-bordered table-hover" id="datatable-productos-add">
                        <thead>
                            <tr>
                                <th>Cod. Prod.</th>
                                <th>Descripcion</th>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Agregar</th>
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
                                <td><?=$value['NombreCategoria']?></td>
                                <td>$ <?=number_format($this->crearproductos->redondear_a_10($value['PrecioventaProducto']),0,",",".")?></td>
                                <td><?php
                                 if(($value['StockProducto']-$value['ReservaProducto'])>0){
                                ?>
                                    <?=form_open("agregar_detalle_solicitud/".$solicitud['idSolicitud'],array("class"=>"form-inline"))?>
                                    <input type="text" class="form-control" value="1" name="txtCantidad" onkeyup="validar_add(<?=($value['StockProducto']-$value['ReservaProducto'])?>,this)" size="4">
                                    <input type="hidden" name="hdIdProducto" value="<?=$value['idproductos']?>">
                                    <input type="hidden" name="hdPrecio" value="<?=$value['PrecioventaProducto']?>">
                                    <input type="hidden" name="url" value="<?=uri_string()?>">
                                    <button type="submit" class="btn btn-default" aria-label="Left Align">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                    </form>
                               <?php
                                 }else{
                                     
                                     echo "Sin Stock";
                                 }
                               ?>
                                </td>
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
                            <tr>
                                <td colspan="9">Sin Datos</td>
                            </tr>
                        <?php



                            }

    ?>
                        </tbody>
                    </table>            
                </div>
            </div>
        </div>
    </div>
</div>