<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('registrar', 'Usuarios::registrar');
$routes->get('iniciar', 'Usuarios::iniciar');
$routes->get('salir', 'Usuarios::salir');

$routes->get('productos', 'Productos::productos');
$routes->get('listar_productos', 'Productos::listar');
$routes->get('verCarrito', 'Carrito::mostrar_carrito');

$routes->post('guardar_registro', 'Usuarios::guardar_registro');
$routes->post('valida_inicio', 'Usuarios::valida_inicio');
$routes->post('addCarrito', 'Carrito::addCarrito');
$routes->post('updateCarrito', 'Carrito::updateCarrito');
$routes->post('updateSession', 'Carrito::updateSession');
$routes->post('deleteCarrito', 'Carrito::deleteCarrito');