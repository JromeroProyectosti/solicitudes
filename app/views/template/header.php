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
    <!--<link href="<?=base_url();?>bootstrap/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">-->
    	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.10/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.1/css/buttons.dataTables.min.css">
    <!-- DataTables Responsive CSS -->
   <!-- <link href="<?=base_url();?>bootstrap/bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">-->
    <script>
        $(function() {
          var availableTags = [
            'ActionScript',
            'AppleScript',
          ];
          $( '#tags' ).autocomplete({
            source: availableTags
          });
        });
    </script>
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
                <a class="navbar-brand" href="<?=base_url()?>"><img src="<?=base_url()?>img/Logo.png" width="145px" height="33px" ></a>
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
                        
                        <li class="divider"></li>
                        <li><a href="<?=base_url()?>login"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <li>
                <a class="navbar-brand" href="http://www.proyectosti.cl" method='blank'><img src="<?=base_url()?>img/logoPT50.png" width="145px" height="33px" ></a>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <?=get_menu_rol()?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">