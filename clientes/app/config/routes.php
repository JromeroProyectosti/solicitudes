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

$route['default_controller'] = "productos/listar";

$route['login']="usuarios";
/*$route['empresa']="empresa/view";
$route['empresa/(:any)']="empresa/view/$1";*/
$route['ingresar_registro']="cli_cliente/ingresar_registro";
$route['registro']="cli_cliente/registro";
$route['recuperar_clave']="cli_cliente/recuperar";
$route['validacion/(:num)']="cli_cliente/validar/$1";
$route['modificar_perfil']="cli_cliente/modificar";
$route['listado_productos']="productos/listar";
$route['listado_productos/(:num)']="productos/listar/$1";
$route['agregar_a_carrito/(:any)']="carrito/agregar_carrito/$1";
$route['eliminar_producto/(:any)']="carrito/eliminar/$1";
$route['carrito']="carrito/listado";
$route['ingresar_solicitud']="cli_solicitud/ingresar_solicitud";

$route['listado_solicitudes']="cli_solicitud/solicitudes";
$route['solicitudes_abiertas']="cli_solicitud/solicitudes_abiertas";
$route['solicitudes_reservadas']="cli_solicitud/solicitudes_reservada";
$route['solicitudes_despachada']="cli_solicitud/solicitudes_despachada";
$route['solicitudes_pagada']="cli_solicitud/solicitudes_pagada";
$route['solicitudes_anulada']="cli_solicitud/solicitudes_anulada";
$route['modificar_solicitud/(:num)']="cli_solicitud/modificar/$1";
$route['detalle_solicitud/(:num)']="cli_solicitud/detalle/$1";
$route['eliminar_solicitud/(:num)']="cli_solicitud/eliminar/$1";


$route['listado_cuentas']="cuentas/listar_todos";
$route['cuentas_pendientes']="cuentas/listar_todos/1";
$route['cuentas_pagadas']="cuentas/listar_todos/2";
$route['detalle_cuentas/(:num)']="cuentas/detalle/$1";

$route['comun/generaoptionciudad']="comun/generaoptionciudad";
$route['comun/generaoptioncomuna']="comun/generaoptioncomuna";
$route['comun/generajsonproductos/(:any)']="comun/generajsonproductos/$1";


//$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */