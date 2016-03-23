<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Perfil</h1>
    </div>
    <!-- /.col-lg-12 -->
    <?php
    if(isset($estado)){
    ?>
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?=$estado?> 
    </div><?php
    }
    ?>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
                          Modificar Vendedor
    </div>
<?php echo form_open('modificar_perfil',array('class'=>'form-horizontal'));?>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtRutVendedor">Rut</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtRutVendedor' value='<?=$vendedor['RutVendedor']?>' disabled=""/>
        </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtRutVendedor')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=form_error('txtRutVendedor')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtNombreVendedor">Nombre</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtNombreVendedor' value='<?=$vendedor['NombreVendedor']?>'/>
        </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtNombreVendedor')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=form_error('txtNombreVendedor')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtApellidoVendedor">Apellido</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtApellidoVendedor' value='<?=$vendedor['ApellidoVendedor']?>'/>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="txtCorreo">Correo</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtCorreo' value='<?=$vendedor['CorreoVendedor']?>'/>
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
            <input type='text' class="form-control" name='txtTelefono' value='<?=$vendedor['TelefonoVendedor']?>'/>
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
            <input type='text' class="form-control" name='txtDireccion' value='<?=$vendedor['DireccionVendedor']?>'/>
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
        <label class="control-label col-sm-2" for="txtComuna">Comuna</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtComuna' value='<?=$vendedor['ComunaVendedor_text']?>'/>
            </div>
        <label class="control-label col-sm-1">*</label>
        <div class="controls col-sm-5">
            <?php 
            if(form_error('txtComuna')){
                ?>
                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <?=form_error('txtComuna')?> 
                </div>
            <?php
            }
            ?>
        </div>
    </div>
   

    <div class="form-group">
        <label class="control-label col-sm-2" for="txtPassword">Password</label>
        <div class="controls col-sm-4">
            <input type='text' class="form-control" name='txtPassword' value=''/>
        </div>
        <div class="controls col-sm-2">
            <input type="checkbox" value="1" name="chkCambiarpass"> Cambiar Password
        </div>
    </div>

		
<p align="center"><button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Modificar</button> 
        <button type="reset" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Limpiar</button></p>
	
</form>
</div>