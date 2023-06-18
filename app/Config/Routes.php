<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

// Routes for Simta_hasilakhir
$routes->get('/simta_hasilakhir', 'Simta_hasilakhir::index');
$routes->get('/simta_hasilakhir/create', 'Simta_hasilakhir::create');
$routes->post('/simta_hasilakhir/store', 'Simta_hasilakhir::store');
$routes->get('/simta_hasilakhir/edit/(:segment)', 'Simta_hasilakhir::edit/$1');
$routes->post('/simta_hasilakhir/update/(:segment)', 'Simta_hasilakhir::update/$1');
$routes->get('/simta_hasilakhir/delete/(:segment)', 'Simta_hasilakhir::delete/$1');
$routes->get('/', 'Simta\UjianProposalController::index');
$routes->get('tambah', 'Simta\UjianProposalController::tambah');
$routes->post('store', 'Simta\UjianProposalController::store');
$routes->post('simpanmahasiswa', 'Simta\UjianProposalController::simpanmahasiswa');
$routes->get('edit/(:any)', 'Simta\UjianProposalController::edit/$1');
$routes->post('update/(:any)', 'Simta\UjianProposalController::update/$1');
$routes->get('editstatus/(:any)', 'Simta\UjianProposalController::editstatus/$1');
$routes->post('updatestatus/(:any)', 'Simta\UjianProposalController::updatestatus/$1');
$routes->get('/', 'Simta\SeminarHasilController::index');
$routes->get('tambah', 'Simta\SeminarHasilController::tambah');
$routes->post('store', 'Simta\SeminarHasilController::store');
$routes->post('simpanmahasiswa', 'Simta\SeminarHasilController::simpanmahasiswa');
$routes->get('edit/(:any)', 'Simta\SeminarHasilController::edit/$1');
$routes->post('update/(:any)', 'Simta\SeminarHasilController::update/$1');
$routes->get('editstatus/(:any)', 'Simta\SeminarHasilController::editstatus/$1');
$routes->post('updatestatus/(:any)', 'Simta\SeminarHasilController::updatestatus/$1');
$routes->get('/', 'Simta\UjianTAController::index');
$routes->get('tambah', 'Simta\UjianTAController::tambah');
$routes->post('store', 'Simta\UjianTAController::store');
$routes->get('edit/(:any)', 'Simta\UjianTAController::edit/$1');
$routes->post('update/(:any)', 'Simta\UjianTAController::update/$1');
$routes->get('editstatus/(:any)', 'Simta\UjianTAController::editstatus/$1');
$routes->post('updatestatus/(:any)', 'Simta\UjianTAController::updatestatus/$1');

//Route Landing
$routes->get('/', 'LandingController::index');
// Route Role Admin
$routes->get('/admin', 'Admin\AdminController::index', ['filter' => 'login']);
$routes->get('/admin', 'Admin\AdminController::index', ['filter' => 'role:admin']);
$routes->get('/admin/index', 'Admin\AdminController::index', ['filter' => 'role:admin']);
$routes->get('/dashboard', 'DashboardController::index', ['filter' => 'login']);
$routes->get('/', 'Home:index', ['filter' => 'login']);
$routes->get('sistem_informasi', 'LandingController::sistem_informasi');
$routes->get('lowongan_kerja', 'LandingController::kerja');
$routes->get('informasi_magang', 'LandingController::magang');
$routes->get('tips_karir', 'LandingController::tips_karir');
$routes->get('agenda', 'LandingController::agenda');
$routes->get('sipema_info', 'LandingController::sipema_info');

$routes->get('/hasilakhir', 'SimtaHasilakhir::index');
$routes->get('/hasilakhir/create', 'SimtaHasilakhir::create');
$routes->post('/hasilakhir/store', 'SimtaHasilakhir::store');
$routes->get('/hasilakhir/edit/(:any)', 'SimtaHasilakhir::edit/$1');
$routes->post('/hasilakhir/update', 'SimtaHasilakhir::update');
$routes->get('/hasilakhir/delete/(:any)', 'SimtaHasilakhir::delete/$1');



