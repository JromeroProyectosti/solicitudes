            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-default btn-circle btn-xl">1</button>
                        <br>
                        <label>Ingresar Factura</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl">2</button>
                        <br>
                        <label>Ingresar Productos</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl">3</button>
                        <br>
                        <label>Finalizar Compra</label>
                    </p>
                </div>
                </div>
            </div>
            <div class="panel panel-default">
               
                <div class="panel-body">

                    

                    <?php echo form_open('ingresar_producto/'.$compra['IdCompra'],array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtRutEmpresa">Rut Empresa</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtRutEmpresa' value='<?=$compra['RutProveedor']?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtRutEmpresa')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtRutEmpresa')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtNombreEmpresa">Nombre Empresa</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtNombreEmpresa' value='<?=$compra['NombreProveedor']?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtNombreEmpresa')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtNombreEmpresa')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                       <div class="form-group">
                        <label class="control-label col-sm-2" for="txtRazonSocial">Raz&oacute;n Social</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtRazonSocial' value='<?=$compra['RazonSocial']?>' />
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtNumero">N&deg; Factura</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtNumero' value='<?=$compra['NumeroCompra']?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtNumero')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtNumero')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtFecha">Fecha Factura</label>
                        <div class="controls col-sm-4">
                            <input type='date' class="form-control" name='txtFecha' value='<?=$compra['FecharegistroCompra']?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtFecha')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtFecha')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtMonto">Monto</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtMonto' value='<?=$compra['Monto']?>' />
                        </div>
                        <label class="control-label col-sm-1">*</label>
                        <div class="controls col-sm-5">
                            <?php 
                            if(form_error('txtMonto')){
                                ?>
                                <div class='alert alert-warning alert-dismissable' id='err_rut' role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?=form_error('txtMonto')?> 
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <p class="text-center"><button type='submit' value='Modificar' class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Siguiente</button> <button type='button'  class="btn btn-outline btn-primary btn-lg" data-loading-text="Loading...">Cancelar</button></p>
                </form>
                </div>
            </div>