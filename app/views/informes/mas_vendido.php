<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Productos mas vendidos</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-info">
    <div class="panel-heading">
        Busqueda
    </div>
        <?=form_open("mas_vendidos",array('class'=>'form-horizontal'))?>
            <div class="form-group">
                <label for="txtFechaInicio" class="control-label col-sm-2">Fecha Inicio</label>
                <div class="controls col-sm-4">
                    <input type="date" name="txtFechaInicio" id="txtFechaInicio" class="form-control" value="<?=set_value("txtFechaInicio")?>" >
                </div>
            </div>
            <div class="form-group">
                <label for="txtFechaFin" class="control-label col-sm-2" >Fecha Fin</label>
                <div class="controls col-sm-4">
                    <input type="date" name="txtFechaFin" id="txtFechaFin" class="form-control" value="<?=set_value("txtFechaFin")?>">
                </div>
            </div>
            <button type='submit' class="btn btn-outline btn-primary btn-lg">Filtrar</button>
            
        </form>
    </div>
<div class="panel panel-default">

    <?php
    echo form_open("informes/exportar",array('class'=>'form-horizontal',"id"=>"FormularioExportacion"));

    ?>
    <input type="button" value="Exportar" class="btn btn-primary" id="btnExportar">
    <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
       <input type="hidden" name="hdInforme" id="hdInforme" class="form-control" value="PRODUCTOS MAS VENDIDOS">
     <input type="hidden" name="hdInicio" id="hdInicio" class="form-control" value="<?=set_value("txtFechaInicio")?>">
     <input type="hidden" name="hdFin" id="hdFin" class="form-control" value="<?=set_value("txtFechaFin")?>">
    </form>
    <p></p>
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Cod. Cat.</th>
                    <th>Descripcion</th>
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