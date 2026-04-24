<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//Rutas publicas (cualquier sitio dentro de la aplicacion que no requiere acceso)
$routes->get('/','AuthController::login');
$routes->get('auth/login','AuthController::login');
$routes->post('auth/login','AuthController::verificar');
$routes->get('auth/login','AuthController::logout');

$routes->get('sin-permiso', function(){
    return view('error/sin-permiso');});
//Rutas protegidas
$routes->group('',['filter'=> 'auth'], function($routes){
   //administradores
   $routes->group('admin',['filter'=>'auth::administrador'], function($routes){

   //Todas las rutas a la que solo los administradores pueden entrar
   $routes->get('dashboard','Admin\DashboardController::index');
   });
   
   //Invitados
   $routes->group('admin',['filter'=>'auth::invitado'], function($routes){});
   $routes->get('dashboard','Invitado\PanelController::index');
});
