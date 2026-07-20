create database if not exists tech;
use tech;

create table if not exists employees (
    id int primary key auto_increment,
    nom varchar(50),
    prenom varchar(50),
    email unique varchar(50),
    date_embauche datetime,
    actif int 
);

create table if not exists departement(
    id int primary key auto_increment,
    nom varchar(50),
    description varchar(50)
);

create table if not exists type_congé(
    id int primary key auto_increment,
    libelle varchar(50),
    jour_annuelle int,
    deductible int
);

create table if not exists soldes(
    id int primary key auto_increment,
    employee_id int,
    type_conge_id int,
    annee int,
    jour_attribues datetime,
    jour_pris datetime,
    FOREIGN KEY (employee_id) REFERENCES employees(id),
    FOREIGN KEY (type_conge_id) REFERENCES type_congé(id)
);

create table if not exists conge(
    id int primary key auto_increment,
    employee_id int,
    type_conge_id int,
    date_debut datetime,
    date_fin datetime,
    nb_jour int,
    motif varchar(50),
    statut varchar(50),
    commentaire_rh varchar(50),
    created_at datetime,
    traiter_par varchar(50);
    foreign key (employee_id) references employees(id),
    foreign key (type_conge_id) references type_congé(id)
);

