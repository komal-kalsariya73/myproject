<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/user', 'UserController::index');
$routes->get('/user/fetchAll', 'UserController::fetchAll');
$routes->post('/user/store', 'UserController::store');
$routes->get('/user/edit/(:num)', 'UserController::edit/$1');
$routes->post('/user/update/(:num)', 'UserController::update/$1');
$routes->post('/user/delete/(:num)', 'UserController::delete/$1');
