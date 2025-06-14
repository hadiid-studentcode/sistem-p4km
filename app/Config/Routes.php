<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// login
$routes->get('/', 'LoginController::index');
$routes->post('/login', 'LoginController::attemptLogin');
$routes->get('/logout', 'LoginController::logout', ['filter' => 'role:kabid,p4km,kepala dinas']);


// dashboard
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'role:kabid,p4km,kepala dinas']);

// jadwal kunjungan
$routes->get('/jadwalkunjungan', 'KunjunganController::index', ['filter' => 'role:kabid']);
$routes->post('/jadwalkunjungan', 'KunjunganController::store', ['filter' => 'role:kabid']);
$routes->put('/jadwalkunjungan/(:num)', 'KunjunganController::update/$1', ['filter' => 'role:kabid']);
$routes->delete('/jadwalkunjungan/(:num)', 'KunjunganController::delete/$1', ['filter' => 'role:kabid']);

// laporan pembinaan
$routes->get('/laporanpembinaan', 'PembinaanController::index', ['filter' => 'role:kabid,p4km']);

// cetak laporan
$routes->get('/cetaklaporan', 'CetakLaporanControler::index', ['filter' => 'role:kepala dinas']);
