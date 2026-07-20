<?php

namespace App\Controllers\Client;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use App\Models\OperateurModel;

class AuthController extends BaseController
{
    /**
     * Affiche le formulaire de connexion (prefixe + numéro).
     */
    public function login()
    {
        $operateurModel = new OperateurModel();

        $data['operateur'] = $operateurModel->getOperateur();

        return view('client/login', $data);
    }

    /**
     * Connexion automatique : si le numéro existe déjà, on connecte le
     * client existant, sinon on le crée directement (pas d'inscription
     * séparée).
     */
    public function loginAction()
    {
        $clientModel    = new ClientModel();
        $operateurModel = new OperateurModel();

        $prefixe = $this->request->getPost('prefixe');
        $numero  = $this->request->getPost('numero');

        if (empty($prefixe) || empty($numero)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Veuillez choisir un opérateur et saisir un numéro.');
        }

        $operateur = $operateurModel->findByPrefixe($prefixe);

        if (! $operateur) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Opérateur inconnu.');
        }

        $numeroComplet = $prefixe . $numero;

        $client = $clientModel->findOrCreateByNumero($numeroComplet);

        $session = session();
        $session->set([
            'isLoggedIn'   => true,
            'id_client'    => $client['id_client'],
            'nom_client'   => $client['nom'],
            'numero'       => $client['numero'],
            'id_operateur' => $operateur['id_operateur'],
            'operateur'    => $operateur['nom'],
        ]);

        return redirect()->to('/client');
    }

    /**
     * Déconnexion du client.
     */
    public function logout()
    {
        session()->destroy();

        return redirect()->to('/client/login');
    }
}
