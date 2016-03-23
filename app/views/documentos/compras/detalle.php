            <div class="panel panel-info">
                <div class="panel-heading">
                          Datos Generales de Factura
                </div>
               
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <td><strong>Rut Empresa</strong></td>
                                <td><?=$compra['RutProveedor']?></td>
                                <td><strong>Nombre Empresa</strong></td>
                                <td><?=$compra['NombreProveedor']?></td>
                            </tr>
                            <tr>
                                <td><strong>Numero Factura</strong></td>
                                <td><?=$compra['NumeroCompra']?></td>
                                <td><strong>Monto</strong></td>
                                <td><?=$compra['Monto']?></td>
                            </tr>
                            <tr>
                                <td><strong>Fecha Factura</strong></td>
                                <td><?=$compra['FecharegistroCompra']?></td>
                                <td>

                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
           
            <div class="panel panel-success">
                <div class="panel-heading">
                          Detalle
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                       
                        <table class="table table-striped  table-bordered table-hover table-condensed" width="100%" id="datatable-productos">
                        <thead>
                            <tr>
                                <th>Cantidad</th>
                                <th>Codigo</th>
                                <th>Codigo Catalogo</th>
                                <th>Descripcion</th>
                                <th >Costo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                <th>Precio Catalogo</th>
                                <th>Iva</th>
                                <th>Neto</th>
                                <th>Comision(30%)</th>
                                <th>Retencion(10%)</th>
                                <th>A Pagar</th>
                                <th>Ganancia</th>
                                <th>Utilidad Empresa</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $i=1;
                        foreach ($listado as $items): ?>
                        
                        <?php 
                        $i++;
                        ?>
                        <tr>
                            <td><?=number_format($items['CantidadDetallecompra'],0,",",".")?>
                                <td><?=$items['CodigoProducto']?></td>
                                <td><?=$items['CodigocatalogoProducto']?></td>
                                <td><?=$items['DescripcionProducto']?></td>
                                <td><?= number_format($this->crearproductos->redondear_a_10($items['PrecioDetallecompra']),0,",",".")?></td>
                                <td><?= number_format($this->crearproductos->redondear_a_10($items['PrecioventaProducto']),0,",",".")?></td>
                                <td><?=  number_format($this->crearproductos->redondear_a_10($items['IvaProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['NetoProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['ComisionProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['RetencionProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['ApagarProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['GananciaProducto']),0,",",".")?></td>
                                <td><?=number_format($this->crearproductos->redondear_a_10($items['UtilidadProducto']),0,",",".")?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        </table>
                        
           
                    </div>
                </div>
            </div>

