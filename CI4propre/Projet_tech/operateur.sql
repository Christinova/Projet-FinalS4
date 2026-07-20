PRAGMA foreign_keys = ON;

CREATE TABLE client (
    id_client INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    numero TEXT UNIQUE NOT NULL
);

CREATE TABLE operateur (
    id_operateur INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prefixe TEXT UNIQUE NOT NULL
);

insert into operateur (nom, prefixe) values ('Orange', '037');
insert into operateur (nom, prefixe) values ('Airtel', '033');
CREATE TABLE frais (
    id_frais INTEGER PRIMARY KEY AUTOINCREMENT,
    montant_min REAL NOT NULL,
    montant_max REAL NOT NULL,
    frais REAL NOT NULL
);

CREATE TABLE "transaction" (
    id_transaction INTEGER PRIMARY KEY AUTOINCREMENT,

    id_client INTEGER NOT NULL,

    id_operateur INTEGER NOT NULL,

    id_frais INTEGER NOT NULL,

    type_transaction TEXT NOT NULL
    CHECK(type_transaction IN('depot','retrait','transfert')),

    montant REAL NOT NULL,

    numero_destinataire TEXT,
    
    frais_inclus INTEGER NOT NULL DEFAULT 1,

    date_transaction TEXT DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(id_client) REFERENCES client(id_client),

    FOREIGN KEY(id_operateur) REFERENCES operateur(id_operateur),

    FOREIGN KEY(id_frais) REFERENCES frais(id_frais)
);
ALTER TABLE "transaction" ADD COLUMN numero_destinataire TEXT;