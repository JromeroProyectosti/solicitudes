
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl" ><i class="fa fa-check"></i></button>
                        <br>
                        <label>Ingresar Factura</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-default btn-circle btn-xl">2</button>
                        <br>
                        <label>Ingresar Productos</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl">3</button>
                        <br>
                        <label>Finalizar Compra</label>
                    </p>
                </div>
                </div>
            </div>
            <div class="panel panel-info">
                <div class="panel-heading">
                          Datos Generales de Factura
                </div>
               
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Rut Empresa</strong></td>
                                <td><?=$compra['RutProveedor']?></td>
                                <td><strong>Nombre Empresa</strong></td>
                                <td><?=$compra['NombreProveedor']?></td>
                            </tr>
                            <tr>
                                <td><strong>Numero Factura</strong></td>
                                <td><?=$compra['NumeroCompra']?></td>
                                <td><strong>Monto</strong></td>
                                <td><?=$compra['Monto']?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha Factura</strong></td>
                                <td><?=$compra['FecharegistroCompra']?></td>
                                <td>

                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="panel panel-yellow">
                <div class="panel-heading">
                          Agregar Producto
                </div>
                <div class="panel-body">
                    <?= form_open("",array('class'=>'form-horizontal','id'=>'frmCargar'))?>
                    <?= form_hidden("hdCompra",$id_compra)?>
                        <div class="form-group">
                            <label class="control-label col-lg-1" for="txtCodigo">Codigo</label>
                            <div class="controls  col-lg-3">
                                <input type='text' class="form-control" name='txtCodigo' id='txtCodigo' onkeypress="cargar_campos(event)"/>
                            </div> 
                            
                            <label class="control-label  col-lg-1" for="txtCodigoCatalogo">Codigo Catalogo</label>
                            <div class="controls  col-lg-3">
                                <input type='text' class="form-control" name='txtCodigoCatalogo' id='txtCodigoCatalogo' disabled  />
                            </div> 
                            <label class="control-label  col-lg-1" for="txtDescripcion">Descripcion</label>
                            <div class="controls  col-lg-3">
                                <input type='text' class="form-control" name='txtDescripcion' id='txtDescripcion'  disabled/>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="control-label col-lg-1" for="txtCantidad">Cantidad</label>
                            <div class="controls  col-lg-3">
                                <input type='text' class="form-control" name='txtCantidad' id='txtCantidad'  disabled/>
                            </div>
                            <label class="control-label col-lg-1" for="txtCosto">Costo</label>
                            <div class="controls  col-lg-3">
                                <input type='text' class="form-control" name='txtCosto' id='txtCosto'  disabled/>
                            </div> 
                            <label class="control-label  col-lg-1" for="txtPrecioCatalogo">Precio Catalogo</label>
                            <div class="controls  col-lg-3">
                                <input type='text' class="form-control" name='txtPrecioCatalogo' id='txtPrecioCatalogo' disabled />
                            </div> 

                        </div>
                        <p class="text-center">
                      
                            <button type="button" class="btn btn-primary"  id="btnEnviar" onclick="javascript:cargar_producto()">Agregar</button>
                       
                            <button class="btn btn-primary" onclick="javascript:cancelar()" type="button">Cancelar</button>
                    </p>
                    </form>
                </div>
            </div>
            <div class="panel panel-success">
                <div class="panel-heading">
                          Detalle
                </div>
                <div class="panel-body">
                    <?=form_open("finaliza_compra/".$id_compra)?>
                    <div class="table-responsive">
                        
                        <table class="table table-striped  table-bordered table-hover table-condensed" width="100%" id="datatable-productos">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Codigo</th>
                                <th>Codigo Catalogo</th>
                                <th>Descripcion</th>
                                <th>Costo</th>
                                <th>SubTotal</th>
                                <th>Precio Catalogo</th>
                                <th>Iva</th>
                                <th>Neto</th>
                                <th>Comision(30%)</th>
                                <th>Retencion(10%)</th>
                                <th>A Pagar</th>
                                <th>Ganancia</th>
                                <th>Utilidad Empresa</th>
                                
                                <th>Modificar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i=1;
                        foreach ($this->cart->contents() as $items): ?>
                        
                        <?php 
                        echo $i;
                        $i++;
                        ?>
                        <tr>
                            <td><?=form_input(array('name' => 'txtCantidad[]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5'))?>
                                <td><?=$items['id']?></td>
                                <td>Codigo Catalogo</td>
                                <td><?=$items['name']?></td>
                                <td><?=form_input(array('name' => 'txtPrecio[]', 'value' => $items['price'], 'maxlength' => '3', 'size' => '5'))?></td>
                                <td><?=number_format($items['subtotal'],0,",",".")?></td>
                                <td><?=form_input(array('name' => 'txtPrecioCatalogo[]', 'value' => $items['catalogo'], 'maxlength' => '3', 'size' => '5'))?></td>
                                <td><?=  number_format($this->crearproductos->redondear_a_10($items['iva']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['neto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['comision']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['retencion']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['apagar']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['ganancia']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['utilidad']),0,",",".")?></td>
                                
                                <td><a href="<?=base_url()?>eliminar_detalle_producto/<?=$items['rowid']?>/<?=$id_compra?>"><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-edit" ></span></button></a></td>
                                <td><a href="<?=base_url()?>eliminar_detalle_producto/<?=$items['rowid']?>/<?=$id_compra?>"><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove" ></span></button></a></td>
                                
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                        <h3>Total Factura compra <span class="label label-default"><?=$this->cart->total()?></span></h3>
                    
                    </div>
                    <p class="text-center">
                        <a href="javascript:window.location.href='<?=base_url()?>ingresar_factura/<?=$id_compra?>'">
                                <button class="btn btn-outline btn-primary btn-lg" type="button">Atras</button>
                            </a>
                            <button type='submit'  class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Siguiente</button>
                        </p>
                </form>
                </div>
            </div>

<script>
window.onload=function(){
    
    $("#txtCodigo").attr("value","");
    $("#txtCodigo").focus();
}
function cargar_campos(e){
//$("form_control").focusout(function(){
//$('#txtCodigo').keyup(function(e){
   if(e.keyCode==13){
        $.post("<?=base_url()?>comun/generajsonproductos/"+$("#txtCodigo").val(), 
        {'nom1' : "valor1", 'nom2' :" valor2"},
        function(data){

            if(data!=false){
                $("#txtCantidad").attr('disabled',false);
                $("#txtCosto").attr('disabled',false);
                $("#txtPrecioCatalogo").attr('disabled',false);
                $("#txtDescripcion").attr('disabled',true);
                $("#txtCodigoCatalogo").attr('disabled',true);
                $.each(data, function(i, val){
                    //$(".contenedor_json").append('<li>' + val.provincia + '</li>');
                    $("#txtCodigoCatalogo").attr('value',val.CodigocatalogoProducto);
                    $("#txtDescripcion").attr('value',val.DescripcionProducto);
                    $("#txtCosto").attr('value',val.PreciocompraProducto);
                    $("#txtPrecioCatalogo").attr('value',val.PrecioventaProducto);
                });
                $("#btnEnviar").attr('disabled',false);
                $("#txtCantidad").focus();
            }else{
                $("#txtCantidad").attr('disabled',false);
                $("#txtCosto").attr('disabled',false);
                $("#txtPrecioCatalogo").attr('disabled',false);
                $("#txtDescripcion").attr('disabled',false);
                $("#txtCodigoCatalogo").attr('disabled',false);
                 $("#txtCantidad").attr('value',"");
                $("#txtCosto").attr('value',"");
                $("#txtPrecioCatalogo").attr('value',"");
                $("#txtDescripcion").attr('value',"");
                $("#txtCodigoCatalogo").attr('value',"");
                $("#btnEnviar").attr('disabled',false);
                $("#txtCodigoCatalogo").focus();
            }
        }, "json"
       );
   }
}
function cancelar(){
    $("#txtCantidad").attr('disabled',true);
    $("#txtCosto").attr('disabled',true);
    $("#txtPrecioCatalogo").attr('disabled',true);
    $("#txtDescripcion").attr('disabled',true);
    $("#txtCodigoCatalogo").attr('disabled',true);
    $("#txtCodigo").attr('value',"");
     $("#txtCantidad").attr('value',"");
    $("#txtCosto").attr('value',"");
    $("#txtPrecioCatalogo").attr('value',"");
    $("#txtDescripcion").attr('value',"");
    $("#txtCodigoCatalogo").attr('value',"");
    $("#btnEnviar").attr('disabled',true);
    $("#txtCodigo").focus();
}
function cargar_producto(){
    document.getElementById("frmCargar").action="<?=base_url()?>agregar_detalle_producto/<?=$id_compra?>";
    document.getElementById("frmCargar").submit();
}
</script>