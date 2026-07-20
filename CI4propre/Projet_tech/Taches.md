[Christinova][Base de donnée:]
-Création de 7 tables: operateur, client , transfert, retrait, depot, compte, transaction
[Sharon]

Cote operateur  [Christinova] 
-Configuration des préfixes des opérateurs [ok]
-Configuration des différentes formes de transaction : transfers, dépôt , retrait
(Avec des frais)[ok]
-Situation de gain via les frais de transaction [ok]
-Situation de compte client [ok]
-Login automatique avec le numéro du client sans inscription [ok]

Cote Client [Sharon]
-Voir solde pour le client [ok]
-faire un dépôt : -Avec les frais dans le barem[ok]
                  -Pas de code personnelle on envoie tout de suite le dépôt[ok]
                  -Même chose retrait[ok]
                  -Même chose transfers [ok]
                  -On peut voir l'historique[ok]
-Configuration des préfixes valable pour les autres opérateurs (ex: 032 et 031, …)
Configuration % en plus de commissions pour les transferts vers les autres opérateurs




Pour se connecter à SQLIte3

public array $default = [
    'DSN'      => '',
    'hostname' => '',
    'username' => '',
    'password' => '',
    'database' => WRITEPATH . 'operateur.db', // chemin vers ton fichier .db
    'DBDriver' => 'SQLite3',
    'DBPrefix' => '',
    'pConnect' => false,
    'DBDebug'  => true,
    'charset'  => 'utf8',
    'DBCollat' => '',
    ];


cd CI4propre/Projet_tech
mkdir -p writable/database
sqlite3 writable/database/operateur.db < operateur.sql


si tu veux supprimer la base de donnée 
-> rm writable/database/operateur.db
