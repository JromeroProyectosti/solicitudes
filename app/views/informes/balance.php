<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Balance</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">

    <?php
    echo form_open("informes/exportar",array('class'=>'form-horizontal',"id"=>"FormularioExportacion"));

    ?>
    <input type="button" value="Exportar" class="btn btn-primary" id="btnExportar">
    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
    </form>
    <p></p>
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">
            <thead>
                <tr>
                    <th>Compras</th>
                    <th>Ventas</th>
                    <th>Por cobrar</th>
                    <th>Cantidad</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php
                        $i=0;
                        if($listado!=FALSE){
                        foreach ($listado as $value): 

                        ?>

                    <tr>
                            <td><?=$value['CodigoProducto']?></td>
                            <td><?=$value['CodigocatalogoProducto']?></td>
                            <td><?=$value['DescripcionProducto']?></td>
                            <td><?=$value['cantidad']?></td>
                               
                    </tr>
                    <?php endforeach;
                        }else{
                            ?>
                    <tr>
                            <td></td>
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