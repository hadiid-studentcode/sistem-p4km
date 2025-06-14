<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login
$routes->get('/', 'LoginController::index');
$routes->post('login', 'LoginController::attemptLogin');


$routes->get('dashboard', 'DashboardController::index');
$routes->get('jadwalkunjungan', 'KunjunganControler::index');
$routes->get('laporanpembinaan', 'PembinaanController::index');
