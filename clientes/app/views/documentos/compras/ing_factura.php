            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Compras</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-check">1</i></button>
                        <br>
                        <label>Ingresar Factura</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-check">2</i></button>
                        <br>
                        <label>Ingresar Productos</label>
                    </p>
                </div>
                <div class="col-lg-4">
                    <p class="text-center">
                        <button type="button" class="btn btn-primary btn-circle btn-xl"><i class="fa fa-check">3</i></button>
                        <br>
                        <label>Finalizar Compra</label>
                    </p>
                </div>
                </div>
            </div>
            <div class="panel panel-default">
               
                <div class="panel-body">

                    

                    <?php echo form_open('ingresar_factura',array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtRutEmpresa">Rut Empresa</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtRutEmpresa' value='<?=set_value("txtRut")?>' />
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
                            <input type='text' class="form-control" name='txtNombreEmpresa' value='<?=set_value("txtNombreEmpresa")?>' />
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
                            <input type='text' class="form-control" name='txtRazonSocial' value='<?=set_value("txtRazonSocial")?>' />
                        </div>
                        
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="txtNumero">N&deg; Factura</label>
                        <div class="controls col-sm-4">
                            <input type='text' class="form-control" name='txtNumero' value='<?=set_value("txtNumero")?>' />
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
                            <input type='text' class="form-control" name='txtFecha' value='<?=set_value("txtNumero")?>' />
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
                            <input type='text' class="form-control" name='txtMonto' value='<?=set_value("txtMonto")?>' />
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