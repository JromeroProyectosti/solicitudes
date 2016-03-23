<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Clientes</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    <?php
    echo form_open("agregar_cliente",array('class'=>'form-horizontal'));

    ?>
    <input type="submit" value="Nuevo Cliente" class="btn btn-primary">
    </form>
    <p></p>
    <div class="panel panel-body">
    <div class="table-responsive">
             <?php
    echo form_open("informes/exportar",array('class'=>'form-horizontal',"id"=>"FormularioExportacion"));

    ?>
            
            <input type="hidden" id="hdExportar" name="hdExportar">
            <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
            <input type="hidden" name="hdInforme" id="hdInforme" class="form-control" value="Vendedores">
             <input type="hidden" name="hdInicio" id="hdInicio" class="form-control" value="">
             <input type="hidden" name="hdFin" id="hdFin" class="form-control" value="<?=date("Y-m-d")?>">
             </form>
           <div id="div-1a">
        <table class="table table-striped  table-bordered table-hover  display nowrap" id="table-listado" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Fecha Registro</th>
                    <th>Correo</th>
                    <th>Region</th>
                    <th>Comuna</th>
                    <th>Estado</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                    if($listado!=FALSE){
                    foreach ($listado as $value): 
                        $comuna=$this->common_model->get_comuna(0,$value['IdComuna']);
                        
                        $region=$this->common_model->get_region($value['IdRegion']);
                    ?>

                <tr>
                    <td><?=$value['RutCliente']?></td>
                    <td><?=$value['NombreCliente']." ".$value['ApellidoCliente']?></td>
                    <td><?=$value['FecharegistroCliente']?></td>
                    <td><?=$value['CorreoCliente']?></td>
                    <td><?=$region[0]['NombreRegion']?></td>
                    <td><?=$comuna[0]['NombreComuna']?></td>
                    <td><?=$value['NombreEstadocliente']?></td>

                    <td>

                        <a href="<?=base_url()?>modificar_cliente/<?=$value['idCliente']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" ></span></button></a>

                    </td>
                    <td><a href="<?=base_url()?>eliminar_cliente/<?=$value['idCliente']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>
                    <td><a href="<?=base_url()?>ingresar_como_cliente/<?=$value['idCliente']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-transfer"></span></button></a></td>
                    <td><a href="<?=base_url()?>generar_venta/<?=$value['idCliente']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-usd"></span></button></a></td>

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
    </div>
</div>