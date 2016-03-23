
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-default btn-circle btn-xl">1</button>
                        <br>
                        <label>Ingresar Factura</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl">2</button>
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
            <div class="panel panel-default">
               
                <div class="panel-body">

                    

                    <?php echo form_open('ingresar_factura',array('class'=>'form-horizontal',"id"=>"frmFactura"));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtRutEmpresa">Rut</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtRutEmpresa' id='txtRutEmpresa' value='<?=set_value("txtRut")?>' onkeydown="accion(event)" placeholder="11111111-1"/>
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtRutEmpresa')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtRutEmpresa')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtNombreEmpresa">Nombre</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtNombreEmpresa' id='txtNombreEmpresa' value='<?=set_value("txtNombreEmpresa")?>' onclick="pinchar()" />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtNombreEmpresa')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtNombreEmpresa')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                       <div class="form-group">
                        <label class="control-label col-sm-2" for="txtRazonSocial">Raz&oacute;n Social</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtRazonSocial' id='txtRazonSocial' value='<?=set_value("txtRazonSocial")?>' />
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtNumero">N&deg; Factura</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtNumero' value='<?=set_value("txtNumero")?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtNumero')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtNumero')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtFecha">Fecha Factura</label>
                        <div class="controls col-sm-4">
                            <input type='date' class="form-control" name='txtFecha' value='<?=set_value("txtFecha")?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtFecha')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtFecha')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtMonto">Monto</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtMonto' value='<?=set_value("txtMonto")?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtMonto')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtMonto')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <p class="text-center">
                       
                        <button type='button'   class="btn btn-outline btn-primary btn-lg" onclick="javascript:enviar()">Siguiente</button> 
                        <button type='button'  class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Cancelar</button>
                    </p>
                </form>
                </div>
            </div>


<script>
function enviar(){
    $("#frmFactura").submit(); 
}
function accion(e){
    //$("form_control").focusout(function(){
    //$('#txtCodigo').keyup(function(e){
    //alert(e.keyCode);
   if(e.keyCode==9 || e.keyCode==13){
      cargar_campos();
   }
}
function pinchar(){
    cargar_campos();
}
function cargar_campos(){
    //$("form_control").focusout(function(){
    //$('#txtCodigo').keyup(function(e){
    //alert(e.keyCode);
       $.post("<?=base_url()?>comun/generajsonempresas/"+$("#txtRutEmpresa").val(), 
        {'nom1' : "valor1", 'nom2' :" valor2"},
        function(data){
            
            if(data!=false){
               
                $.each(data, function(i, val){
                    //$(".contenedor_json").append('<li>' + val.provincia + '</li>');
      
                    $("#txtNombreEmpresa").attr('value',val.NombreProveedor);
                    $("#txtRazonSocial").attr('value',val.RazonSocial);
                    
                });
               
                $("#txtNumero").focus();
            }else{
              
                $("#txtNombreEmpresa").focus();
            }
        }, "json"
       );
   
}
</script>