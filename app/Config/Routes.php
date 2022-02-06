<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */



$routes->get('/', 'PublicoController/Home::principal',['filter' => 'auth']);

$routes->get('/detalleIndicador/(:num)', 'PublicoController\Home::detalleIndicador/$1');
$routes->get('/inicio', 'PublicoController/Home::index',['filter' => 'auth']);
$routes->get('/consulta', 'PublicoController/Home::consulta',['filter' => 'auth']);
$routes->get('/consultaDetalle', 'PublicoController/Home::consultaDetalle/');
$routes->get('/antecedentes', 'PublicoController/Home::antecedentes/');
$routes->get('/consecuentes', 'PublicoController/Home::consecuentes/');

$routes->get('/admin/consultaMetas/(:num)', 'AdminController\Home::consultaMetas/$1',['filter' => 'auth']);

$routes->get('/admin/inicio', 'AdminController/Home::index/',['filter' => 'auth']);
$routes->get('/admin/indicadores', 'AdminController/Home::indicadores/',['filter' => 'auth']);

$routes->get('/admin/consultaIndicador', 'AdminController/Home::consultaIndicador/');
$routes->post('/admin/accion_indicador', 'AdminController/Home::accion_indicador/');
$routes->get('/admin/obtenerAnteConse', 'AdminController/Home::obtenerAnteConse/');
$routes->get('/admin/obtenerIndicadoresPorArea', 'AdminController/Home::obtenerIndicadoresPorArea/');

$routes->get('/admin/consultaMetaModal', 'AdminController/Home::consultaMetaModal/');
$routes->post('/admin/accion_meta', 'AdminController/Home::accion_meta/');

$routes->get('/admin/lineasEstrategicas', 'AdminController/Home::lineasEstrategicas/',['filter' => 'auth']);
$routes->post('/admin/accion_linea', 'AdminController/Home::accion_linea/');

$routes->get('/admin/nivelesBsc', 'AdminController/Home::nivelesBsc/',['filter' => 'auth']);
$routes->post('/admin/accion_nivel', 'AdminController/Home::accion_nivel/');

$routes->get('/admin/departamentos', 'AdminController/Home::departamentos/',['filter' => 'auth']);
$routes->post('/admin/accion_departamento', 'AdminController/Home::accion_departamento/');

$routes->post('/admin/accion_ante_con', 'AdminController/Home::accion_ante_con/');
$routes->post('/admin/accion_ante_con_add', 'AdminController/Home::accion_ante_con_add/');


$routes->get('/admin/usuarios', 'AdminController/Home::usuarios/',['filter' => 'auth']);
$routes->post('/admin/accion_usuario', 'AdminController/Home::accion_usuario/');
$routes->get('/admin/consultaUsuario', 'AdminController/Home::consultaUsuario/');


$routes->get('/login', 'AdminController/Home::login/',['filter' => 'noauth']);
$routes->post('/accion_login', 'AdminController/Home::accion_login/');

$routes->get('/admin/permisos', 'AdminController/Home::permisos/',['filter' => 'auth']);
$routes->get('/admin/obtenerSubmenuUsuario', 'AdminController/Home::obtenerSubmenuUsuario/');
$routes->post('/admin/accion_permiso', 'AdminController/Home::accion_permiso/');

$routes->get('/salir', 'AdminController/Home::salir/');

$routes->get('/admin/obtenerPermisosUsuarios', 'AdminController/Home::obtenerPermisosUsuarios/');
$routes->get('/admin/obtenerIndicadoresPorAreaUsuPer', 'AdminController/Home::obtenerIndicadoresPorAreaUsuPer/');
$routes->post('/admin/accion_indicador_usuario', 'AdminController/Home::accion_indicador_usuario/');

$routes->get('/admin/grafica', 'AdminController/Home::grafica/',['filter' => 'auth']);
$routes->get('/admin/obtenerIndicadoresGrafica', 'AdminController/Home::obtenerIndicadoresGrafica/');



/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
