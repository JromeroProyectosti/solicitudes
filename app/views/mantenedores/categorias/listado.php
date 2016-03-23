<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Categorias</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     <?php
    echo form_open("crear_categoria",array('class'=>'form-horizontal'));

    ?>
    <input type="submit" value="Nuevo Categoria" class="btn btn-primary">
    </form>
    <p></p>
    
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th width="10px"></th>
                    <th width="10px"></th>
                </tr>
            </thead>
            <tbody>
            <?php
                        $i=0;
                        if($listado!=FALSE){
                        foreach ($listado as $value): 

                        ?>

                    <tr>
                            <td><?=$value['NombreCategoria']?></td>
                           <td><a href="<?=base_url()?>modificar_categoria/<?=$value['idCategoria']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-edit" ></span></button></a></td>
                            <td><a href="<?=base_url()?>eliminar_categoria/<?=$value['idCategoria']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                           
                    </tr>
                    <?php endforeach;
                        }else{
                            ?>
                    <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            
                    </tr>
                    <tr><td colspan="9">Sin Datos</td></tr>
                    <?php
                            
                        }
?>
                </tbody>
            </table>            
</div>