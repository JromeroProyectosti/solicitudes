<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <div class="panel-heading">
                          Modificar Usuario
    </div>
<?php echo form_open('modificar_usuario/'.$usuario['RutUsuario'],array('class'=>'form-horizontal'));?>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtRutUsuario">Rut</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtRutUsuario' value='<?=$usuario['RutUsuario']?>' disabled=""/>
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
    <label class="control-label col-sm-2" for="txtNombreUsuario">Nombre</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtNombreUsuario' value='<?=$usuario['NombreUsuario']?>'/>
    </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtNombreUsuario')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=form_error('txtNombreUsuario')?> 
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtApellidoUsuario">Apellido</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtApellidoUsuario' value='<?=$usuario['ApellidoUsuario']?>'/>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtCorreo">Correo</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtCorreo' value='<?=$usuario['CorreoUsuario']?>'/>
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
    <label class="control-label col-sm-2" for="cboTipo1">Rol</label>
    <div class="controls col-sm-4">
        <select id='cboTipo' name="cboTipo1" class="form-control">
	<?php foreach($tipo as $row):?>
            <option value='<?=$row['idTipousuario']?>' 
             <?php if($row['idTipousuario']==$usuario['idTipousuario']){ echo 'selected';}?>
                    ><?=$row['NombreTipousuario']?></option>
            <?php 
            
       endforeach
        ?>
        </select>
    </div>
</div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="cboEstado1">Estado</label>
    <div class="controls col-sm-4">
        <select id='cboEstado' name="cboEstado1"  class="form-control">
	<?php foreach($estado as $row):?>
            <option value='<?=$row['idEstadousuario']?>' 
                    <?php if($row['idEstadousuario']==$usuario['idEstadousuario']){ echo 'selected';}?>
             ><?=$row['NombreEstadousuario']?></option>
            <?php 
            
       endforeach
        ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtUsuario">Usuario</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtUsuario' value='<?=$usuario['UsuarioUsuario']?>'/>
        </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtUsuario')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=form_error('txtUsuario')?> 
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
   
</div>

		
<p align="center"><button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Modificar</button> 
        <button type="reset" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Limpiar</button></p>
	
</form>
</div>