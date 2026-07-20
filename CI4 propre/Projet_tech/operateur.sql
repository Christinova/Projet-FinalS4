create database operateur;
use operateur;

create table client (
    id_client int primary key auto_increment,
    nom varchar(50) not null,
    numero_telephone varchar(15) unique not null

);

create table compte(
    id_compte int primary key auto_increment,
    id_client int not null,
    solde decimal(10,2) default 0.00,
    date_creation datetime default current_timestamp,
    foreign key (id_client) references client(id_client)
);

create table operateur(
    id_operateur int primary key auto_increment,
    nom varchar(50) not null,
    numero_telephone varchar(15) unique not null
);

create table transaction(
    id_transaction int primary key auto_increment,
    id_client int not null,
    montant decimal(10,2) not null,
    type_transaction enum('depot', 'retrait', 'transfert') not null,
    date_transaction datetime default current_timestamp,
    foreign key (id_client) references client(id_client)
);

create table frais(
    id_frais int primary key auto_increment,
    type_transaction varchar(50) not null,
    montant1 decimal(10,2) not null,
    montant2 decimal(10,2) not null
);

create table depot(
    id_depot int primary key auto_increment,
    id_client int not null,
    montant decimal(10,2) not null,
    date_depot datetime default current_timestamp,
    foreign key (id_client) references client(id_client),
    foreign key (id_client) references compte(id_client)
);

create table retrait(
    id_retrait int primary key auto_increment,
    id_client int not null,
    montant decimal(10,2) not null,
    date_retrait datetime default current_timestamp,
    foreign key (id_client) references client(id_client)
);

create table transfert(
    id_transfert int primary key auto_increment,
    id_client_emetteur int not null,
    id_client_recepteur int not null,
    montant decimal(10,2) not null,
    date_transfert datetime default current_timestamp,
    foreign key (id_client_emetteur) references client(id_client),
    foreign key (id_client_recepteur) references client(id_client)
);
