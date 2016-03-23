<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Categoria</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <div class="panel-heading">
                         Modificar Categoria
    </div>
    
    <?php echo form_open('modificar_categoria/'.$id_categoria,array('class'=>'form-horizontal',"id"=>"form_envio"));?>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtNombre">Nombre</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtNombre' value='<?=$producto['NombreCategoria']?>' />
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

<p align="center"><button type='submit' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Modificar</button> 
   <button type="button" onclick="javascript:window.location.href='<?=base_url()?>listado_categoria'" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Cancelar</button>
      </p>
	
</form>

</div>

