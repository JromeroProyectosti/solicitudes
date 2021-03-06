<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";

$route['login']="usuarios";
/*$route['empresa']="empresa/view";
$route['empresa/(:any)']="empresa/view/$1";*/
//Iniciar como vendedor
$route['ingresar_como_vendedor/(:num)']="usuarios/cli_ini_session/$1";


$route['guardar_empresa']="empresa/guardarempresa";
$route['listado_empresas']="sec_empresa/listado_empresas";
$route['addempresa']="sec_empresa/addempresa";
$route['modificar_empresa/(:any)']="sec_empresa/modificar_empresa/$1";
$route['detalle_empresa/(:any)']="sec_empresa/detalle_empresa/$1";
$route['eliminar_empresa/(:any)']="sec_empresa/eliminar_empresa/$1";

$route['crear_usuario']="sec_usuario/crear";
$route['modificar_usuario/(:any)']="sec_usuario/modificar/$1";
$route['listado_usuarios']="sec_usuario/listar";
$route['permiso_usuario/(:any)']="sec_usuario/permiso/$1";
$route['listado_sucursal']="listado_sucursal";
$route['listado_productos']="sec_productos/listar";
$route['listado_categoria']="sec_productos/listar_categoria";

$route['crear_producto']="sec_productos/crear";
$route['crear_categoria']="sec_productos/crear_categoria";
$route['modificar_producto/(:num)']="sec_productos/modificar/$1";
$route['modificar_categoria/(:num)']="sec_productos/modificar_categoria/$1";
$route['eliminar_producto/(:num)']="sec_productos/eliminar/$1";
$route['eliminar_categoria/(:num)']="sec_productos/eliminar_categoria/$1";
$route['listado_compras']="sec_ingreso/listar";
$route['ingresar_factura']="sec_ingreso/factura";

$route['ingresar_factura/(:any)']="sec_ingreso/factura/$1";
$route['ingresar_producto/(:num)']="sec_ingreso/producto/$1";
$route['agregar_detalle_producto/(:num)']="sec_ingreso/agregar_detalle/$1";
$route['eliminar_detalle_producto/(:any)/(:num)']="sec_ingreso/eliminar_detalle/$1/$2";
$route['finaliza_compra/(:num)']="sec_ingreso/finaliza/$1";
$route['finaliza_proceso/(:num)']="sec_ingreso/terminar_proceso/$1";
$route['detalle_compra/(:num)']="sec_ingreso/detalle/$1";
$route['eliminar_compra/(:num)']="sec_ingreso/eliminar_compra/$1";


$route['comun/generaoptionciudad']="comun/generaoptionciudad";
$route['comun/generaoptioncomuna']="comun/generaoptioncomuna";
$route['comun/generajsonproductos/(:any)']="comun/generajsonproductos/$1";
$route['registro']="clientes/registro";


///informes
$route['stock']="sec_productos/stock";
$route['informe_cuentas']="cuentas/informe";
$route['mas_vendidos']="sec_productos/stock_mas_vendido";

////Routes Cliente

$route['listado_vendedores']="cli_cliente/listar_todos";
$route['listado_vendedores_validar']="cli_cliente/listar_por_validar";
$route['modificar_vendedor/(:num)']="cli_cliente/modificar/$1";
$route['eliminar_vendedor/(:num)']="cli_cliente/eliminar/$1";
$route['validacion/(:num)']="cli_cliente/validar/$1";
$route['listado_solicitudes']="cli_solicitud/solicitudes";
$route['solicitudes_abiertas']="cli_solicitud/solicitudes_abiertas";
$route['solicitudes_reservadas']="cli_solicitud/solicitudes_reservada";
$route['solicitudes_despachada']="cli_solicitud/solicitudes_despachada";
$route['solicitudes_pagada']="cli_solicitud/solicitudes_pagada";
$route['solicitudes_anulada']="cli_solicitud/solicitudes_anulada";
$route['modificar_solicitud/(:num)']="cli_solicitud/modificar/$1";
$route['modificar_abiertas/(:num)']="cli_solicitud/abiertas/$1";

$route['modificar_reservadas/(:num)']="cli_solicitud/reservadas/$1";
$route['modificar_despachadas/(:num)']="cli_solicitud/despachadas/$1";
$route['modificar_pagadas/(:num)']="cli_solicitud/pagadas/$1";
$route['modificar_anuladas/(:num)']="cli_solicitud/anuladas/$1";

$route['detalle_solicitud/(:num)']="cli_colicitud/detalle/$1";
$route['eliminar_solicitud/(:num)']="cli_colicitud/eliminar/$1";

$route['eliminar_cuentas/(:num)']="cuentas/eliminar/$1";
$route['cuentas']="cuentas/listar_todos";
$route['generar_cuentas']="cuentas/generar_estados_cuentas";
$route['listado_cuentas']="cuentas/listar_todos";
$route['cuentas_pendientes']="cuentas/listar_todos/1";
$route['cuentas_pagadas']="cuentas/listar_todos/2";
$route['cuentas_atrasadas']="cuentas/listar_atrasados";
$route['detalle_cuentas/(:num)']="cuentas/detalle/$1";
$route['cambiar_venta']="cuentas/modificar_venta";
$route['exportar']="comun/exportar";

//$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */