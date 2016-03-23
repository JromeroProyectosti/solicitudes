<div class="row">

    <div class="col-lg-12">

        <h1 class="page-header">Productos</h1>

    </div>

    <!-- /.col-lg-12 -->

</div>

<div class="panel panel-default">



    

    <div class="table-responsive">

         

        <table class="table table-striped  table-bordered table-hover" id="datatable-productos">

            <thead>

                <tr>

                                 <th>Cod. Prod.</th>

                    <th>Descripcion</th>

                    <th>Producto</th>

                    <th>Precio</th>

                    

                    <th>Agregar</th>

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

                            <td><?=$value['NombreCategoria']?></td>

                            <td>$ <?=number_format($this->crearproductos->redondear_a_10($value['PrecioventaProducto']),0,",",".")?></td>

                            

                            <td>

                                

                                  <?=form_open("agregar_a_carrito/".$value['idproductos'],array("class"=>"form-inline","onsubmit"=>"return validar(".($value['StockProducto']-$value['ReservaProducto']).",this)"))?>

                                <input type="text" class="form-control" value="1" name="txtCantidad" size="4">

                                <input type="hidden" name="url" value="<?=uri_string()?>">

                                        <button type="submit" class="btn btn-default" aria-label="Left Align">

                                            <span class="glyphicon glyphicon-plus"></span>

                                        </button>

                                   

                                </form>

                              

                            </td>

                           

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

                    <tr><td colspan="9">Sin Datos</td></tr>

                    <?php

                            

                        }

?>

                </tbody>

            </table>            

</div>