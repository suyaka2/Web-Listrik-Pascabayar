<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login-pelanggan', 'Login::form_login');
$routes->get('/login-admin', 'Login::login_admin');
$routes->get('/dashboard', 'Dashboard::dashboard_admin');
$routes->get('/dashboard-pelanggan', 'Dashboard::dashboard_pelanggan');
$routes->get('/admin/data-pelanggan', 'Admin::master_data_pelanggan');
$routes->get('/admin/data-tarif', 'Admin::master_data_tarif');
$routes->get('/admin/data-penggunaan', 'Admin::master_data_penggunaan');
$routes->get('/admin/data-tagihan', 'Admin::master_data_tagihan');
$routes->get('/admin/data-pembayaran', 'Admin::master_data_pembayaran');
$routes->post('/login/autentikasi-admin', 'Login::autentikasi_admin');
$routes->post('/login/autentikasi-pelanggan', 'Login::autentikasi_pelanggan');
$routes->post('/simpan-data-tarif', 'Admin::simpan_data_tarif');
$routes->post('/simpan-data-pelanggan', 'Admin::simpan_data_pelanggan');
$routes->post('/simpan-data-penggunaan', 'Admin::simpan_data_penggunaan');
$routes->post('/simpan-pembayaran', 'Admin::simpan_data_pembayaran');
$routes->post('/update-data-tarif', 'Admin::update_data_tarif');
$routes->post('/update-data-pelanggan', 'Admin::update_data_pelanggan');
$routes->post('/update-data-penggunaan', 'Admin::update_data_penggunaan');

$routes->get('/hapus-data-tarif/(:any)', 'Admin::hapus_data_tarif/$1');    
$routes->get('/hapus-data-pelanggan/(:any)', 'Admin::hapus_data_pelanggan/$1');    
$routes->get('/hapus-data-penggunaan/(:any)', 'Admin::hapus_data_penggunaan/$1');    

$routes->get('/logout', 'Login::logout');
$routes->get('/logout-pelanggan', 'Login::logout_pelanggan');
$routes->get('/logout-admin', 'Login::logout');

$routes->get('/pelanggan/data-tagihan', 'Pelanggan::tagihan');
$routes->get('/pelanggan/data-pembayaran', 'Pelanggan::pembayaran');
$routes->post('/pelanggan/simpan-pembayaran', 'Pelanggan::simpan_pembayaran_pelanggan');

// Rute untuk AJAX get meter terakhir
$routes->post('/admin/get-meter-terakhir', 'Admin::get_meter_terakhir');