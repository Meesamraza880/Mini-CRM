<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->get('/', 'Home::login');
$routes->post('/login_process', 'Home::login_process');
$routes->get('/forget_pass', 'Home::forget_pass');
$routes->post('/forget_process', 'Home::forget_process');
$routes->get('/new_pass/', 'Home::new_pass');
$routes->post('/new_pass_process', 'Home::new_pass_process');
$routes->get('/admin_dashboard', 'Home::admin_dashboard');
$routes->get('/sub_admin_dashboard', 'Home::sub_admin_dashboard');
$routes->get('/logout', 'Home::logout');
$routes->post('/add_company', 'store::add_company');
$routes->post('/show_company', 'store::show_company');
$routes->post('/edit_company', 'store::edit_company');
$routes->post('/update_company', 'store::update_company');
$routes->post('/delete_company', 'store::delete_company');

$routes->post('/add_employee', 'store::add_employee');
$routes->post('/show_employee', 'store::show_employee');
$routes->post('/edit_employee', 'store::edit_employee');
$routes->post('/update_employee', 'store::update_employee');
$routes->post('/delete_employee', 'store::delete_employee');


$routes->post('/sub_admin_add_employee', 'StoreSubAdmin::sub_admin_add_employee');
$routes->post('/sub_admin_show_employee', 'StoreSubAdmin::sub_admin_show_employee');
$routes->post('/sub_admin_edit_employee', 'StoreSubAdmin::sub_admin_edit_employee');
$routes->post('/sub_admin_update_employee', 'StoreSubAdmin::sub_admin_update_employee');
$routes->post('/sub_admin_delete_employee', 'StoreSubAdmin::sub_admin_delete_employee');
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
