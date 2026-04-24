<?php
use CodeIgniter\Router\RouteCollection;
/** @var RouteCollection $routes */

// Rutas públicas
$routes->get('/', 'AuthController::logout');
$routes->get('auth/login', 'AuthController::login');
$routes->post('auth/login', 'AuthController::verificar');
$routes->get('auth/logout', 'AuthController::logout');

$routes->get('sin-permiso', function(){
    return view('errors/sin-permiso');  
});

// Rutas protegidas
$routes->group('admin', ['filter' => 'auth::administrador'], function($routes){
    $routes->get('dashboard', 'Admin\DashboardController::index');
});

$routes->group('invitado', ['filter' => 'auth::invitado'], function($routes){
    $routes->get('dashboard', 'Invitado\PanelController::index');  
});