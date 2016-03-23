<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Stock</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">

    <?php
    echo form_open("informes/exportar",array('class'=>'form-horizontal',"id"=>"FormularioExportacion"));

    ?>
    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
    <input type="hidden" name="hdInforme" id="hdInforme" class="form-control" value="Stock en Bodega">
     <input type="hidden" name="hdInicio" id="hdInicio" class="form-control" value="">
     <input type="hidden" name="hdFin" id="hdFin" class="form-control" value="<?=date("Y-m-d")?>">
    </form>
    <p></p>
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">
            <thead>
                <tr>
                    <th>Codigo</th>
                   
                    <th>Descripcion</th>
                    
                    <th>Cantidad</th>
                    <th>Cant $</th>
                    <th>Reservado</th>
                    <th>Res $</th>
                    <th>Disponible</th>
                    <th>Disp $</th>
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
                            <td><?=$value['DescripcionProducto']?></td>
                            <td><?=$value['StockProducto']?></td>
                            <td><?=($value['StockProducto']*$value['PrecioventaProducto'])?></td>
                            <td><?=$value['ReservaProducto']?></td> 
                            <td><?=($value['ReservaProducto']*$value['PrecioventaProducto'])?></td> 
                            <td><?=($value['StockProducto']-$value['ReservaProducto'])?></td>
                            <td><?=(($value['StockProducto']-$value['ReservaProducto'])*$value['PrecioventaProducto'])?></td>
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
                    <tr><td colspan="9">Sin Datos</td></tr>
                    <?php
                            
                        }
?>
                </tbody>
            </table>            
</div>