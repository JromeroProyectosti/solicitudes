<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Producto</h1>

    </div>

    <!-- /.col-lg-12 -->

</div>

<div class="panel panel-default">

    <div class="panel-heading">

                          Modificar Producto

    </div>

    

    <?php echo form_open('modificar_producto/'.$id_producto,array('class'=>'form-horizontal',"id"=>"form_envio"));?>

<div class="form-group">

    <label class="control-label col-sm-2" for="txtCodigo">C&oacute;digo Producto</label>

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

    <label class="control-label col-sm-2" for="cboCategoria">Categoria</label>

    <div class="controls col-sm-4">

        

        <select class="form-control" name="cboCategoria">

            <option value="0">-- Seleccionar Categoria --</option>

            <?php

                    foreach ($categorias as $options): 

                        ?>

            <option value="<?=$options['idCategoria']?>" 

            <?php if($options['idCategoria']==$producto['idCategoria']) echo "selected";?>

                    ><?=$options['NombreCategoria']?></option>

            <?php

                    endforeach;

            ?>

        </select>

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

    <label class="control-label col-sm-2" for="txtPrecioCatalogo">Precio</label>

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

<div class="form-group">

    <label class="control-label col-sm-2" for="txtStock">Stock</label>

    <div class="controls col-sm-4">

        <input type='text' class="form-control" name='txtStock' value='<?=$producto['StockProducto']?>' />

    </div>

    <label class="control-label col-sm-1"></label>

    <div class="controls col-sm-5">

        

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

    <button type="button" onclick="javascript:window.location.href='<?=base_url()?>listado_productos'" class="btn btn-outline btn-primary btn-lg" data-oading-text="Cargando....">Cancelar</button>

      </p>

	

</form>



</div>



