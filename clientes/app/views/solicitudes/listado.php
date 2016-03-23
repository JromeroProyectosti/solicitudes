<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Solicitudes</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
     
    <div class="panel panel-body">
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-solicitudes">
            <thead>
                <tr>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Forma Envio</th>
                    <th>Numero Envio</th>
                    <th>Fecha Solicitud</th>
                    <th>Estado</th>
                    <th>Total Ganancia</th>
                    <th>Total A Pagar</th>
                    <th>Detalle</th>
                   
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
                    <td><?=$value['RutCliente']?></td>
                    <td><?=$value['NombreCliente']." ".$value['ApellidoCliente']?></td>
                    <td><?=$value['CorreoCliente']?></td>
                    <td><?=$value['NombreFormaenvio']?></td>
                    <td><?=$value['NumeroenvioSolicitud']?></td>
                    <td><?=$value['FechaingresoSolicitud']?></td>
                    <td><?=$value['NombreEstadosolicitud']?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10($value['TotalgananciaSolicitud']),0,",",".")?></td>
                    <td><?=number_format($this->crearproductos->redondear_a_10($value['TotalapagarSolicitud']),0,",",".")?></td>

                    <td><a href="<?=base_url()?>detalle_solicitud/<?=$value['idSolicitud']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" ></span></button></a></td>
                    <td><a href="<?=base_url()?>eliminar_solicitud/<?=$value['idSolicitud']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove"></span></button></a></td>

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


                </tr>
                <?php

                }
                        ?>
                
            </tbody>
        </table>
    </div>
    </div>
</div>