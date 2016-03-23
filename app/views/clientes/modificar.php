<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Clientes</h1>
    </div>
    <!-- /.col-lg-12 -->
    <?php
    if(isset($estado_mail)){
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?=$estado_mail?> 
    </div><?php
    }
    ?>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
                          Modificar Cliente
    </div>
<?php echo form_open('modificar_cliente/'.$vendedor['idCliente'],array('class'=>'form-horizontal'));?>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtRutCliente">Rut</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtRutCliente' value='<?=$vendedor['RutCliente']?>' disabled=""/>
        </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtRutCliente')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=form_error('txtRutCliente')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtNombreCliente">Nombre</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtNombreCliente' value='<?=$vendedor['NombreCliente']?>'/>
        </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtNombreCliente')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=form_error('txtNombreCliente')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtApellidoCliente">Apellido</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtApellidoCliente' value='<?=$vendedor['ApellidoCliente']?>'/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtCorreo">Correo</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtCorreo' value='<?=$vendedor['CorreoCliente']?>'/>
            </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtCorreo')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?=form_error('txtCorreo')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtTelefono">Telefono</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtTelefono' value='<?=$vendedor['TelefonoCliente']?>'/>
            </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtTelefono')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?=form_error('txtTelefono')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtDireccion">Direccion</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtDireccion' value="<?=$vendedor['DireccionCliente']?>"/>
            </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtDireccion')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?=form_error('txtDireccion')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="cboVendedor">Vendedor Asignado</label>
        <div class="controls col-sm-4">
            <select name="cboVendedor" class="form-control" id="cboVendedor" >
                <option>Seleccionar Vendedor</option>
                <?php
                foreach($vendedores as $item_vendedor):
                ?>
                <option value="<?=$item_vendedor['idUsuario']?>"
                <?php
                    if($item_vendedor['idUsuario']==$vendedor['idVendedor']) echo " selected ";
                ?>
                ><?=$item_vendedor['NombreUsuario']?> <?=$item_vendedor['ApellidoUsuario']?></option>

                <?php
                endforeach;
                ?>
            </select>
        </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('cboVendedor')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=form_error('cboVendedor')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
                        <label class="control-label col-sm-2" for="cboRegion">Region</label>
                        <div class="controls col-sm-4">
                            <select name="cboRegion" class="form-control" id="cboRegion"  onchange="change_ciudad()">
                                <option>Seleccionar Region</option> 
                                <?php
                                foreach($region as $item_region):
                                ?>
                                <option value="<?=$item_region['IdRegion']?>"
                                <?php
                                if($item_region['IdRegion']==$vendedor['IdRegion']) echo " selected ";
                                ?>
                                        
                                ><?=$item_region['NombreRegion']?></option>

                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('cboRegion')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('cboRegion')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cboCudad">Ciudad</label>
                        <div class="controls col-sm-4">
                            <select name="cboCiudad" class="form-control" id="cboCiudad"  onchange="change_comuna()">
                                <option>Seleccionar Ciudad</option>
                                <?php
                                foreach($ciudad as $item_ciudad):
                                ?>
                                <option value="<?=$item_ciudad['IdCiudad']?>"
                                <?php
                                if($item_ciudad['IdCiudad']==$vendedor['IdCiudad']) echo " selected ";
                                ?>
                                        
                                ><?=$item_ciudad['NombreCiudad']?></option>

                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('cboCiudad')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('cboCiudad')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cboComuna">Comuna</label>
                        <div class="controls col-sm-4">
                            <select name="cboComuna" class="form-control" id="cboComuna" >
                                <option>Seleccionar Comuna</option>
                                <?php
                                foreach($comuna as $item_comuna):
                                ?>
                                <option value="<?=$item_comuna['IdComuna']?>"
                                <?php
                                if($item_comuna['IdComuna']==$vendedor['IdComuna']) echo " selected ";
                                ?>
                                        
                                ><?=$item_comuna['NombreComuna']?></option>

                                <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('cboComuna')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('cboComuna')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cboComuna">Observaciones</label>
                        <div class="controls col-sm-4">
                            <textarea name="txtObservacion" maxlength="5000"  cols="100" rows="5" ><?=$vendedor['ObservacionesCliente']?></textarea>
                        </div>
                    </div>
<p align="center"><button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Modificar</button> 
        <button type="reset" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Limpiar</button></p>
	
</form>
</div>

<script>
        
    function change_ciudad(){
        $(document).ready(function(){
            $.ajax({
                url:"<?=base_url()?>comun/generaoptionciudad",
                type: "POST",
                data:"region="+$("#cboRegion").val(),
                success: function(opciones){
                  $("#cboCiudad").html(opciones);
                  $("#cboCiudad").attr("disabled",false);
                  $("#cboComuna").attr("disabled",true);
                }
            });
        });
    }
    function change_comuna(){
        $(document).ready(function(){
            $.ajax({
                url:"<?=base_url()?>comun/generaoptioncomuna",
                type: "POST",
                data:"ciudad="+$("#cboCiudad").val(),
                success: function(opciones){
                  $("#cboComuna").html(opciones);
                  $("#cboComuna").attr("disabled",false);
                }

            });
        });
    }
    </script>