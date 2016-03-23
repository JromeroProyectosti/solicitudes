<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Producto</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <div class="panel-heading">
                          Nueva Categoria
    </div>
    
    <?php echo form_open('crear_categoria',array('class'=>'form-horizontal'));?>
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

<p align="center"><button type='submit' class="btn btn-outline btn-primary btn-lg" >Crear</button> 
        <button type="reset" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Limpiar</button></p>
	
</form>

</div>