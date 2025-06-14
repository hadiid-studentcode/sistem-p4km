<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login
$routes->get('/', 'LoginController::index');
$routes->post('login', 'LoginController::attemptLogin');


$routes->get('dashboard', 'DashboardController::index', ['filter' => 'role:kabid,p4km,kepala dinas']);
$routes->get('jadwalkunjungan', 'KunjunganController::index', ['filter' => 'role:kabid']);
$routes->get('laporanpembinaan', 'PembinaanController::index', ['filter' => 'role:kabid,p4km']);
$routes->get('cetaklaporan', 'CetakLaporanControler::index', ['filter' => 'role:kepala dinas']);
