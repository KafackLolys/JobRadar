<?php

//Connexion
function getConnexion(){
    return new PDO("mysql:host=localhost;dbname=jobradar;charset=utf8","root","");
}

//Création des table si elle n'existe pas
function tryTable(){
  $pdo = getConnexion();

  $Create= "CREATE TABLE IF NOT EXISTS user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nom varchar(100) NOT NULL,
  prenom varchar(100) NOT NULL,
  sexe varchar(8) NOT NULL,
  email varchar(100) NOT NULL,
  pays varchar(100) NOT NULL,
  tel int NOT NULL,
  description text NOT NULL,
  prophile text NOT NULL,
  password varchar(20) NOT NULL
);
CREATE TABLE IF NOT EXISTS experiance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    titre varchar(100) NOT NULL,
    description text NOT NULL,
    foreign key(id_user) references user(id)
  );

  CREATE TABLE IF NOT EXISTS entreprise (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    nom varchar(100) NOT NULL,
    description text NOT NULL,
    prophile text NOT NULL,
    foreign key(id_user) references user(id)
  );

  CREATE TABLE IF NOT EXISTS piece_jointe (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_experiance int,
    id_entreprise int,
    titre varchar(100) NOT NULL,
    description text NOT NULL,
    type varchar(100) NOT NULL,
    element text NOT NULL,
    foreign key(id_experiance) references experiance(id),
    foreign key(id_entreprise) references entreprise(id)
  );

  CREATE TABLE IF NOT EXISTS role (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    role varchar(100) NOT NULL
  );
  
  
  CREATE TABLE IF NOT EXISTS message (
    id int AUTO_INCREMENT PRIMARY KEY,
    contenu text NOT NULL,
    date date() NOT NULL,
    heure time() NOT NULL
  );
  CREATE TABLE IF NOT EXISTS message_entreprise_user (
    id_message int PRIMARY KEY,
    id_user int,
    id_entreprise int,
    emeteur varchar(),
    foreign key(id_user) references user(id),
    foreign key(id_entreprise) references entreprise(id)
  );
  CREATE TABLE IF NOT EXISTS message_entreprise_entreprise (
    id_message int PRIMARY KEY,
    id_emeteur int,
    id_recepteur int,
    foreign key(emeteur) references entreprise(id),
    foreign key(recepteur) references entreprise(id)
  );
  CREATE TABLE IF NOT EXISTS message_user_user (
    id_message int PRIMARY KEY,
    id_emeteur int,
    id_recepteur int,
    foreign key(emeteur) references user(id),
    foreign key(recepteur) references user(id)
  );
  CREATE TABLE IF NOT EXISTS annonce (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    id_entreprise int,
    titre varchar(100),
    description text NOT NULL,
    image text NOT NULL,
    like int NOT NULL,
    foreign key(id_user) references user(id),
    foreign key(id_entreprise) references entreprise(id)
  );
  CREATE TABLE IF NOT EXISTS commantaire (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_user int,
    id_annonce int,
    contenu text NOT NULL,
    date date() NOT NULL,
    heure time() NOT NULL
  );
  CREATE TABLE IF NOT EXISTS abonnement (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_createur_contenus int,
    id_suiveur int,
    foreign key(id_createur_contenus) references user(id),
    foreign key(id_suiveur) references user(id)
  );
  CREATE TABLE IF NOT EXISTS notification (
    id int AUTO_INCREMENT PRIMARY KEY,
    id_abonnement int,
    id_annonce int,
    foreign key(id_abonnement) references abonnement(id),
    foreign key(id_annonce) references annonce(id)
  );
  
";
$stmt = $pdo->prepare($Create);
$stmt->execute();
}

?>
