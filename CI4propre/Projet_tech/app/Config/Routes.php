<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'OperateurController::index');
$routes->post('operateur/ajouter', 'OperateurController::ajouter');


