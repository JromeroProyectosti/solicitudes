<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Ventas</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="panel panel-default">
    
    <div class="panel panel-body">
        
    <div class="table-responsive">
         
        <table class="table table-striped  table-bordered table-hover" id="datatable-cuentas">
            <thead>
                <tr>
                    <th>N&deg;</th>
                    <th>Rut</th>
                    <th>Nombre</th>
                    <th>Fecha cuenta</th>
                    <th>Fecha de Pago</th>
                    <th>Fecha Pagado</th>
                    <th>Estado</th>

                    <th>Total a Pagar</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=0;
                    if($listado!=FALSE){
                    foreach ($listado as $value): 
                    ?>
                    <tr>
                        <td><?=$value['idCuenta']?></td>
                        <td><?=$value['RutCliente']?></td>
                        <td><?=$value['NombreCliente']." ".$value['ApellidoCliente']?></td>
                        <td><?=$value['FechaingresoCuenta']?></td>
                        <td><?=$value['FechapagoCuenta']?></td>
                        <td><?=$value['FechapagadoCuenta']?></td>
                        <td><?=$value['NombreEstadocuenta']?></td>
                        
                        <td><?=number_format($this->crearproductos->redondear_a_10($value['TotalapagarCuenta']),0,",",".")?></td>
                        <td><a href="<?=base_url()?>detalle_venta/<?=$value['idCuenta']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-eye-open" ></span></button></a></td>
                        <td><a href="<?=base_url()?>eliminar_cuentas/<?=$value['idCuenta']?>" ><button type="button" class="btn btn-default" aria-label="Left Align"><span class="glyphicon glyphicon-remove" ></span></button></a></td>
                    
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