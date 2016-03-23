<!DOCTYPE html>
<html lang="en">

    <head>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<title>Administracion Compra Online</title>

        <!-- Bootstrap Core CSS -->
    <link href="<?=base_url();?>bootstrap/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url();?>bootstrap/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=base_url();?>bootstrap/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url();?>bootstrap/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=base_url();?>bootstrap/bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url();?>bootstrap/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- DataTables CSS -->
    <link href="<?=base_url();?>bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?=base_url();?>bootstrap/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

</head>
<body>
<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url()?>img/logoPT50.png" width="145px" height="33px" ></a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <?=$this->session->userdata('nombre_completo')?> / <?=$this->session->userdata('rol')?>
                </li>
                <?=get_alerta()?>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>login"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        
                        <li>
                            <a href="#"><i class="fa  fa-wrench fa-fw"></i> Mantenedores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url();?>listado_empresas" >Proveedores</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>listado_usuarios">Usuarios</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>listado_productos">Productos</a>
                                </li>
                                <li>
                                    <a href="<?=base_url();?>listado_categoria">Categorias</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Documentos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?=base_url();?>listado_compras" >Compras</a>
                                    
                                </li>  
                            
                                <li>
                                    <a href="#" >Estado de Cuentas <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                <li>
                                <a href="<?=base_url()?>listado_cuentas">Todos  </a>
                                </li>
                                <li>
                                <a href="<?=base_url()?>cuentas_pendientes">Cuentas Pendientes <?=
get_cuentas_estado(1)?> </a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>cuentas_pagadas">Cuentas Pagadas <?=
get_cuentas_estado(2)?> </a>
                                </li>
                            </ul>
                                </li>  
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                       <li>
                            <a href="#"><i class="fa  fa-shopping-cart fa-fw"></i> Vendedores<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Solicitudes<span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                        <a href="<?=base_url()?>listado_solicitudes">Todos  </a>
                                        </li>
                                        <li>
                                        <a href="<?=base_url()?>solicitudes_abiertas">Nuevas solicitudes <?=
    get_solicitudes_abierta(1)?> </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>solicitudes_reservadas">Solicitudes Reservadas <?=
        get_solicitudes_abierta(2)?> </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>solicitudes_despachada">Solicitudes Despachadas <?=
        get_solicitudes_abierta(3)?> </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>solicitudes_pagada">Solicitudes Pagadas </a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url()?>solicitudes_anulada">Solicitudes Anulada </a>
                                        </li>
                                        
                                    </ul>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>listado_vendedores">Vendedores</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa  fa-shopping-cart fa-fw"></i> Informes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                <a href="<?=base_url()?>stock">Stock  </a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>informe_cuentas">Cuentas por Cobrar</a>
                                </li>
                                <li>
                                    <a href="<?=base_url()?>mas_vendidos">Productos Mas Vendidos</a>
                                </li>  
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">