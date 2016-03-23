
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Proveedores</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<?php
echo form_open("addempresa");
?>
<input type="submit" value="Nuevo Proveedor" class="btn btn-primary">
</form>
<div class="table-responsive">
    <table class="table table-striped  table-bordered table-hover" id="table-proveedor">
        <thead>
            <tr >
                <th></th>
                   
                    <th>Nombre</th>
                    <th>Razon Social</th>
                    <th></th>
                    <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                $i=0;
                foreach ($listado as $value): 

                ?>

            <tr  >
                <th scope="row"></th>
                  
                    <td><?=$value['NombreProveedor']?></td>

                    <td><?=$value['RazonSocial']?></td>
                    
                    <td><a href="<?=base_url()?>modificar_empresa/<?=$value['idProveedor']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-edit" ></span></button></a></td>
                    <td><a href="<?=base_url()?>eliminar_empresa/<?=$value['idProveedor']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                    </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
