[Christinova][Base de donnée:]
-Création de 7 tables: operateur, client , transfert, retrait, depot, compte, transaction
[Sharon]

[Tache en générale]
-Configuration des préfixes des opérateurs []
-Configuration des différentes formes de transaction : transfers, dépôt , retrait
(Avec des frais)[]
-Situation de gain via les frais de transaction []
-Situation de compte client []
-Login automatique avec le numéro du client sans inscription []

Les Opérations qu'on doit être capable de faire 
-Voir solde pour le client []
-faire un dépôt : -Avec les frais dans le barem[]
                  -Pas de code personnelle on envoie tout de suite le dépôt[]
                  -Même chose retrait[]
                  -Même chose transfers []
                  -On peut voir l'historique[]


Page opérateur:
page déroulente : opérateur: 033 / 037 : On appuie sur 033 -> 033 [suite numéro client]
page déroulente : différente transaction : transfers, dépôt , retrait


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
