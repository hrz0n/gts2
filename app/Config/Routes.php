<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('/logout', 'Login::logout', ['filter' => 'authGuard']);
$routes->post('/login/auth', 'Login::loginAuth');

$routes->get('/admin', 'Admin::index', ['filter' => 'authGuard']);
$routes->get('/admin/index.html', 'Admin::index', ['filter' => 'authGuard']);
// master penduduk
$routes->get('/admin/master/penduduk.html', 'Penduduk::index', ['filter' => 'authGuard']);
$routes->get('/admin/master/penduduk/index_ajax', 'Penduduk::getDataAjax', ['filter' => 'authGuard']);
$routes->post('/admin/master/penduduk/simpan', 'Penduduk::simpan', ['filter' => 'authGuard']);
$routes->post('/admin/master/penduduk/detail/(:num).html', 'Penduduk::detail/$1', ['filter' => 'authGuard']);
$routes->post('/admin/master/penduduk/hapus', 'Penduduk::hapus', ['filter' => 'authGuard']);
$routes->post('/admin/master/penduduk/edit', 'Penduduk::edit', ['filter' => 'authGuard']);
$routes->get('/admin/master/penduduk/cetak/pdf', 'Penduduk::cetakWargaPDF', ['filter' => 'authGuard']);
$routes->get('/admin/master/penduduk/cetak/excel', 'Penduduk::cetakWargaPDF', ['filter' => 'authGuard']);
$routes->get('/admin/master/penduduk/index_filter/(:segment)/(:segment)', 'Penduduk::getWargaFillter/$1/$2', ['filter' => 'authGuard']);

// index warga
$routes->get('/warga', 'Warga::index', ['filter' => 'authGuard']);
$routes->get('/warga/index.html', 'Warga::index', ['filter' => 'authGuard']);

// master kegiatan
$routes->get('/admin/master/kegiatan.html', 'Kegiatan::index', ['filter' => 'authGuard']);
$routes->get('/admin/master/kegiatan/index_ajax', 'Kegiatan::getDataAjax', ['filter' => 'authGuard']);
// $routes->post('/admin/master/kegiatan/simpan', 'Kegiatan::simpan', ['filter' => 'authGuard']);
// $routes->post('/admin/master/kegiatan/detail/(:num).html', 'Kegiatan::detail/$1', ['filter' => 'authGuard']);
// $routes->post('/admin/master/kegiatan/hapus', 'Kegiatan::hapus', ['filter' => 'authGuard']);
// $routes->post('/admin/master/kegiatan/edit', 'Kegiatan::edit', ['filter' => 'authGuard']);
// $routes->get('/admin/master/kegiatan/cetak/pdf', 'Kegiatan::cetakWargaPDF', ['filter' => 'authGuard']);
// $routes->get('/admin/master/kegiatan/cetak/excel', 'Kegiatan::cetakWargaPDF', ['filter' => 'authGuard']);
// $routes->get('/admin/master/kegiatan/index_filter/(:segment)/(:segment)', 'Kegiatan::getWargaFillter/$1/$2', ['filter' => 'authGuard']);

// master penaftaran anggota
$routes->get('/admin/master/anggota.html', 'Pendaftaran::index', ['filter' => 'authGuard']);
$routes->get('/admin/master/anggota/index_ajax', 'Pendaftaran::getDataAjax', ['filter' => 'authGuard']);
$routes->get('/admin/master/anggota/getkegiatan/(:num)', 'Kegiatan::getAllKegiatanAjax/$1', ['filter' => 'authGuard']);
$routes->post('/admin/master/anggota/simpankegiatan', 'Pendaftaran::simpan', ['filter' => 'authGuard']);
$routes->get('/admin/master/anggota/getkegiatanuser/(:num)', 'Pendaftaran::getKegiatanAjax/$1', ['filter' => 'authGuard']);
