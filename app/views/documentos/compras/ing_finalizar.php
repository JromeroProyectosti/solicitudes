
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-default btn-circle btn-xl" ><i class="fa fa-check"></i></button>
                        <br>
                        <label>Ingresar Factura</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-default btn-circle btn-xl"><i class="fa fa-check"></i></button>
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
           
            <div class="panel panel-success">
                <div class="panel-heading">
                          Detalle
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <?=form_open("finaliza_proceso/".$id_compra)?>
                        <table class="table table-striped  table-bordered table-hover table-condensed" width="100%" id="datatable-productos">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Codigo</th>
                                <th>Codigo Catalogo</th>
                                <th>Descripcion</th>
                                <th >Costo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
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
                        foreach ($listado as $items): ?>
                        
                        <?php 
                        $i++;
                        ?>
                        <tr>
                            <td><?=number_format($items['CantidadDetallecompra'],0,",",".")?>
                                <td><?=$items['CodigoProducto']?></td>
                                <td><?=$items['CodigocatalogoProducto']?></td>
                                <td><?=$items['DescripcionProducto']?></td>
                                <td><?= number_format($this->crearproductos->redondear_a_10($items['PrecioDetallecompra']),0,",",".")?></td>
                                <td><?= number_format($this->crearproductos->redondear_a_10($items['PrecioventaProducto']),0,",",".")?></td>
                                <td><?=  number_format($this->crearproductos->redondear_a_10($items['IvaProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['NetoProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['ComisionProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['RetencionProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['ApagarProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['GananciaProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['UtilidadProducto']),0,",",".")?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                        <p class="text-center">
                            <a href="javascript:window.location.href='<?=base_url()?>ingresar_producto/<?=$id_compra?>'">
                                <button class="btn btn-outline btn-primary btn-lg" type="button">Atras</button>
                            </a>
                            <button type='submit'  class="btn btn-outline btn-primary btn-lg">Finalizar</button>
                        </p>
                    </form>
                    </div>
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