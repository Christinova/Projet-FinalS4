<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */$routes->get('/', 'AccueilController::index');

$routes->get('operateur', 'OperateurController::index');

$routes->post('operateur/ajouter', 'OperateurController::ajouter');

$routes->get('historique', 'HistoriqueTransaction::index');