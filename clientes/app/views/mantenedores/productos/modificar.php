<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Producto</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <div class="panel-heading">
                          Nuevo Productoff
    </div>
    
    <?php echo form_open('modificar_producto/'.$id_producto,array('class'=>'form-horizontal',"id"=>"form_envio"));?>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtCodigo">C&oacute;digo</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtCodigo' value='<?=$producto['CodigoProducto']?>' />
    </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtCodigo')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=form_error('txtCodigo')?> 
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtCodigoCatalogo">C&oacute;digo Catalogo</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtCodigoCatalogo' value='<?=$producto['CodigocatalogoProducto']?>' />
    </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtCodigoCatalogo')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=form_error('txtCodigoCatalogo')?> 
            </div>
        <?php
        }
        ?>
    </div>
</div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="txtDescripcion">Descripci&oacute;n</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtDescripcion' id="txtDescripcion" value='<?=$producto['DescripcionProducto']?>' />
    </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtDescripcion')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=form_error('txtDescripcion')?> 
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtCosto">Costo</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtCosto' value='<?=$producto['PreciocompraProducto']?>' />
    </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtCosto')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=form_error('txtCosto')?> 
            </div>
        <?php
        }
        ?>
    </div>
</div>
<div class="form-group">
    <label class="control-label col-sm-2" for="txtPrecioCatalogo">Precio Catalogo</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtPrecioCatalogo' value='<?=$producto['PrecioventaProducto']?>' />
    </div>
    <label class="control-label col-sm-1">*</label>
    <div class="controls col-sm-5">
        <?php 
        if(form_error('txtPrecioCatalogo')){
            ?>
            <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?=form_error('txtPrecioCatalogo')?> 
            </div>
        <?php
        }
        ?>
    </div>
</div>
<!---
<div class="form-group">
    <label class="control-label col-sm-2" for="txtIva">Iva</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtIva' value='<?=set_value("txtIva")?>' />
    </div>
   
</div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="txtNeto">Neto</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtNeto' value='<?=set_value("txtNeto")?>' />
    </div>
    
</div>
</div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="txtNeto">Neto</label>
    <div class="controls col-sm-4">
        <input type='text' class="form-control" name='txtNeto' value='<?=set_value("txtNeto")?>' />
    </div>
    
</div>-->
<p align="center"><button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Modificar</button> 
    <button type='button' value='Duplicar' onclick="javascript:Duplicar()" class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Duplicar</button>
    <button type="button" onclick="javascript:window.location.href='<?=base_url()?>listado_productos'" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Cancelar</button>
      </p>
	
</form>

</div>

<script>
    function Duplicar(){
        document.getElementById('form_envio').action="<?=base_url()?>crear_producto";
        document.getElementById('txtDescripcion').value+="(Copia)";
        document.getElementById('form_envio').submit();
        
    }
 </script>