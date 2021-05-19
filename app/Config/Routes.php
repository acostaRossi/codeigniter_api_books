<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('', ['filter' => 'login'], function($routes)
{
	$routes->get('/', 'Home::index');

	$routes->get('books', 'Home::index');

	$routes->get('books/list', 'Home::list');

	$routes->put('books/create', 'Home::create');

	$routes->get('books/new', 'Home::new');

	$routes->get('books/(:any)', 'Home::edit/$1');

	$routes->post('books/(:any)', 'Home::update/$1');
});

$routes->group('api', function($routes)
{
	$routes->post('auth', 'ApiAuth::authenticate');

	$routes->post('register', 'ApiAuth::attemptRegister');

	$routes->group('', ['filter' => 'jwt'], function($routes)
	{
	    $routes->get('books', 'Api::index');

	    $routes->get('books/(:any)', 'Api::edit/$1');

	    $routes->put('books/create', 'Api::create');

	    $routes->post('books/(:any)', 'Api::update/$1');

	    $routes->delete('books/(:any)', 'Api::delete/$1');
    });
});

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
