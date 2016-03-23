<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


	<title>Registro</title>
        
        <link href="<?=base_url();?>css/bootstrap.css" rel="stylesheet" media="screen">
        <!--<link href="<?=base_url();?>css/signin.css" rel="stylesheet">-->
        <link href="<?=base_url();?>bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

</head>
    <body>
        <div class="container">
            <div class="row">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Registro NUTRAMARKET
                </div>
                <div class="panel-body">
<?php echo form_open('registro',array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtRutUsuario">Rut</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtRutUsuario' value='<?=set_value("txtRutUsuario")?>' placeholder="11111111-1" />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtRutUsuario')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtRutUsuario')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtNombre">Nombre</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtNombre' value='<?=set_value("txtNombre")?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtNombre')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtNombre')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtApellido">Apellido</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtApellido' value='<?=set_value("txtApellido")?>'  />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtApellido')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtApellido')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="cboRegion">Region</label>
                        <div class="controls col-sm-4">
                            <select name="cboRegion" class="form-control" id="cboRegion" onchange="change_ciudad()">
                                <option value="0">Seleccionar Region</option> 
                                <?php
                                foreach($region as $item_region):
                                ?>
                                <option value="<?=$item_region['IdRegion']?>"><?=$item_region['NombreRegion']?></option>

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
                            <select name="cboCiudad" class="form-control" id="cboCiudad" disabled onchange="change_comuna()">
                                <option value="0">Seleccionar Ciudad</option>
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
                            <select name="cboComuna" class="form-control" id="cboComuna" onchange="set_ciudad()" disabled>
                                <option value="0">Seleccionar Comuna</option>
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
                        <label class="control-label col-sm-2" for="txtTelefono">Telefono</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtTelefono' value='<?=set_value("txtTelefono")?>'  />
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
                            <input type='text' class="form-control" name='txtDireccion' value='<?=set_value("txtDireccion")?>'  />
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
                        <label class="control-label col-sm-2" for="txtEmail">Email</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtEmail' value='<?=set_value("txtEmail")?>'  />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtEmail')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtEmail')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtEmailR">Re Ingrese Email</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtEmailR' value='<?=set_value("txtEmailR")?>'  />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtEmailR')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtEmailR')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>

                        <label class="control-label" >Tienes Experiencia en Venta por Catalogo</label>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>

                        <div class="controls col-sm-8">
                            <input type="radio" name="rdExperiencia" value="si">
                            <label class="control-label">SI</label>
                            <input type="radio" name="rdExperiencia" value="no">
                            <label class="control-label">NO</label>
                        </div>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('rdExperiencia')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('rdExperiencia')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>

                        <label class="control-label" >¿Como te enteraste de nosotros?</label>

                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>

                        <div class="controls col-sm-2">
                            <input type="radio" name="rdEnteraste"  value="facebook" >
                            <label class="control-label">Facebook</label>
                        </div>
                        <div class="controls col-sm-1">
                            <input type="radio" name="rdEnteraste" value="google">
                            <label class="control-label">Google</label>
                        </div>
                        <div class="controls col-sm-2">  
                            <input type="radio" name="rdEnteraste" value="web">
                            <label class="control-label">Por una Pagina Web</label> 
                               
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2"></label>

                        <div class="controls col-sm-2">
                            
                            <input type="radio" name="rdEnteraste" id="optionsRadios1" value="amigo" >
                                <label class="control-label">Un amigo</label>
                        </div>
                        <div class="controls col-sm-1">
                            <input type="radio" name="rdEnteraste" id="optionsRadios1" value="flyer" >
                            <label class="control-label">Flyer</label>
                        </div>
                        <div class="controls col-sm-2">
                            <input type="radio" name="rdEnteraste" id="optionsRadios1" value="otro">
                                <label class="control-label">Otro</label>
                              
                        </div>                   
                    </div>
                    <div class="controls col-sm-5">
                            <?php 
                            if(form_error('rdEnteraste')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('rdEnteraste')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    <button type="submit" >Registrar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
        
        
        
    <!-- jQuery -->
    <script src="<?=base_url();?>bootstrap/bower_components/jquery/dist/jquery.min.js"></script>
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
               
                }
            });
            $.ajax({
                url:"<?=base_url()?>comun/generaoptioncomuna",
                type: "POST",
                data:"region="+$("#cboRegion").val(),
                success: function(opciones){
                  $("#cboComuna").html(opciones);
                  $("#cboComuna").attr("disabled",false);
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
    function set_ciudad(){
        $(document).ready(function(){
            $.ajax({
                url:"<?=base_url()?>comun/generaoptionciudad",
                type: "POST",
                data:"region="+$("#cboRegion").val()+"&comuna="+$("#cboComuna").val(),
                success: function(opciones){
                   
                  $("#cboCiudad").html(opciones);
                 
                }
            });
        });
    }
    </script>
    </body>
    
</html>