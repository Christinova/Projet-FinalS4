PRAGMA foreign_keys = ON;

CREATE TABLE client (
    id_client INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    numero_telephone TEXT UNIQUE NOT NULL
);

CREATE TABLE compte (
    id_compte INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client INTEGER NOT NULL,
    solde REAL DEFAULT 0.00,
    date_creation TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE TABLE operateur (
    id_operateur INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    numero_telephone TEXT UNIQUE NOT NULL
);

CREATE TABLE "transaction" (
    id_transaction INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client INTEGER NOT NULL,
    montant REAL NOT NULL,
    type_transaction TEXT NOT NULL
        CHECK(type_transaction IN ('depot','retrait','transfert')),
    date_transaction TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE TABLE frais (
    id_frais INTEGER PRIMARY KEY AUTOINCREMENT,
    type_transaction TEXT NOT NULL,
    montant1 REAL NOT NULL,
    montant2 REAL NOT NULL
);

CREATE TABLE depot (
    id_depot INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client INTEGER NOT NULL,
    montant REAL NOT NULL,
    date_depot TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE TABLE retrait (
    id_retrait INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client INTEGER NOT NULL,
    montant REAL NOT NULL,
    date_retrait TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES client(id_client)
);

CREATE TABLE transfert (
    id_transfert INTEGER PRIMARY KEY AUTOINCREMENT,
    id_client_emetteur INTEGER NOT NULL,
    id_client_recepteur INTEGER NOT NULL,
    montant REAL NOT NULL,
    date_transfert TEXT DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client_emetteur) REFERENCES client(id_client),
    FOREIGN KEY (id_client_recepteur) REFERENCES client(id_client)
);