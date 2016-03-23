<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <div class="panel-heading">
Permisos
    </div>
    <div class="panel-body">
    <?php
   
    echo form_open('permiso_usuario/'.$rut);
    foreach($permisos as $row):
    
    ?>
    <div class="col-lg-4">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <?=$row['NombrePermiso']?>
            </div>
            <div class="panel-body">
                <?= get_acciones($row['idPermiso'],$rut)?>
            </div>
           
        </div>
    </div>
    
    <?php    endforeach ?>
    <div class="col-sm-12">
    <button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Guardar Cambios</button> 
    </div>
</form>
    
    
    </div>
    
</div>
