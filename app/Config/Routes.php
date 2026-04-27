<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index', ['filter' => 'auth']); //mengakses rute ini harus login dulu

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('produk', 'ProdukController::index', ['filter' => 'auth']); //mengakses rute ini harus login
$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth']); //mengakses rute ini harus login