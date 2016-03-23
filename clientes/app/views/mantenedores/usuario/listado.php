<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    
    <?php
    echo form_open("crear_usuario",array('class'=>'form-horizontal'));

    ?>
    <input type="submit" value="Nuevo Usuario" class="btn btn-primary">
    </form>
    <p></p>
    <div class="table-responsive">
            <table class="table table-striped  table-bordered table-hover" id="dataTables-usuario">
                <thead>
                    <tr>
                            <th>Rut</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Usuario</th>
                            <th>Fecha Registro</th>
                            <th>Fecha ult. ingreso</th>
                            <th>Permisos</th>
                            <th>Modificar</th>
                            <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $i=0;
                        if($listado!=FALSE){
                        foreach ($listado as $value): 

                        ?>

                    <tr>
                            <td><?=$value['RutUsuario']?></td>
                            <td><?=$value['NombreUsuario']." ".$value['ApellidoUsuario']?></td>
                            <td><?=$value['CorreoUsuario']?></td>
                            <td><?=$value['UsuarioUsuario']?></td>
                            <td><?=$value['FecharegistroUsuario']?></td>
                            <td><?=$value['FechaultimoingresoUsuario']?></td>
                            <td><a href="<?=base_url()?>permiso_usuario/<?=$value['RutUsuario']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-filter" ></span></button></a></td>
                           <td><a href="<?=base_url()?>modificar_usuario/<?=$value['RutUsuario']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-edit" ></span></button></a></td>
                            <td><a href="<?=base_url()?>eliminar_usuario/<?=$value['RutUsuario']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                
                    </tr>
                    <?php endforeach; 
                        }else{
                            ?>
                    
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                           <td></td>
                            <td></td>
                            
                    </tr>
                    <?php
                        }
?>
                </tbody>
            </table>
        </div>
</div>
