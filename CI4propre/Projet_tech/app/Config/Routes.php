<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AccueilController::index');

$routes->get('operateur', 'OperateurController::index');
$routes->post('operateur/ajouter', 'OperateurController::ajouter');
$routes->get('historique', 'HistoriqueTransaction::index');
$routes->get('situation', 'SituationController::index');
$routes->get('situation_montant', 'SituationMontantController::index');

$routes->get('client/login', 'Client\AuthController::login');
$routes->post('client/login', 'Client\AuthController::loginAction');
$routes->get('client/logout', 'Client\AuthController::logout');


$routes->group('client', ['filter' => 'clientauth'], static function ($routes) {
    $routes->get('/', 'Client\DashboardController::index');

    $routes->get('depot', 'Client\OperationController::depot');
    $routes->post('depot', 'Client\OperationController::depotAction');

    $routes->get('retrait', 'Client\OperationController::retrait');
    $routes->post('retrait', 'Client\OperationController::retraitAction');

    $routes->get('transfert', 'Client\OperationController::transfert');
    $routes->post('transfert', 'Client\OperationController::transfertAction');

    $routes->get('historique', 'Client\HistoriqueController::index');

});
