<?php

// Connexion
function getConnexion() {
    return new PDO("mysql:host=localhost;dbname=jobradar;charset=utf8", "root", "");
}

// Création des tables si elles n'existent pas
function tryTable() {
    $pdo = getConnexion();

    $tables = [
        "CREATE TABLE IF NOT EXISTS chomeur (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            sexe VARCHAR(8) NOT NULL,
            email VARCHAR(255) NOT NULL,
            pays VARCHAR(100) NOT NULL,
            tel VARCHAR(15) NOT NULL,
            description TEXT NOT NULL,
            prophile TEXT NOT NULL,
            password VARCHAR(255) NOT NULL
        )",

        "CREATE TABLE IF NOT EXISTS employeur (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            prenom VARCHAR(100) NOT NULL,
            sexe VARCHAR(8) NOT NULL,
            email VARCHAR(255) NOT NULL,
            pays VARCHAR(100) NOT NULL,
            tel VARCHAR(15) NOT NULL,
            description TEXT NOT NULL,
            prophile TEXT NOT NULL,
            password VARCHAR(255) NOT NULL
        )",
        
        "CREATE TABLE IF NOT EXISTS experiance (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_chomeur INT,
            titre VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            FOREIGN KEY (id_chomeur) REFERENCES chomeur(id)
        )",

        "CREATE TABLE IF NOT EXISTS entreprise (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_employeur INT,
            nom VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            prophile TEXT NOT NULL,
            FOREIGN KEY (id_employeur) REFERENCES employeur(id)
        )",

        "CREATE TABLE IF NOT EXISTS piece_jointe (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_experiance INT,
            id_entreprise INT,
            titre VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            type VARCHAR(100) NOT NULL,
            element TEXT NOT NULL,
            FOREIGN KEY (id_experiance) REFERENCES experiance(id),
            FOREIGN KEY (id_entreprise) REFERENCES entreprise(id)
        )",

        "CREATE TABLE IF NOT EXISTS role (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_chomeur INT,
            id_employeur INT,
            role VARCHAR(100) NOT NULL,
            FOREIGN KEY (id_chomeur) REFERENCES chomeur(id),
            FOREIGN KEY (id_employeur) REFERENCES employeur(id)
        )",

        "CREATE TABLE IF NOT EXISTS annonce (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_entreprise INT,
            titre VARCHAR(100) NOT NULL,
            description TEXT NOT NULL,
            image TEXT NOT NULL,
            likes INT NOT NULL,
            FOREIGN KEY (id_entreprise) REFERENCES entreprise(id)
        )",

        "CREATE TABLE IF NOT EXISTS postulation (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_chomeur INT,
            id_annonce INT,
            date DATE NOT NULL DEFAULT CURRENT_DATE,
            heure TIME NOT NULL DEFAULT CURRENT_TIME,
            FOREIGN KEY (id_chomeur) REFERENCES chomeur(id),
            FOREIGN KEY (id_annonce) REFERENCES annonce(id)
        )",

        "CREATE TABLE IF NOT EXISTS commantaire (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_chomeur INT,
            id_employeur INT,
            id_annonce INT,
            contenu TEXT NOT NULL,
            date DATE NOT NULL DEFAULT CURRENT_DATE,
            heure TIME NOT NULL DEFAULT CURRENT_TIME,
            FOREIGN KEY (id_chomeur) REFERENCES chomeur(id),
            FOREIGN KEY (id_employeur) REFERENCES employeur(id)
        )",

        "CREATE TABLE IF NOT EXISTS abonnement (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_createur_contenus INT,
            id_suiveur INT,
            FOREIGN KEY (id_createur_contenus) REFERENCES entreprise(id),
            FOREIGN KEY (id_suiveur) REFERENCES chomeur(id)
        )",

        "CREATE TABLE IF NOT EXISTS notification (
            id INT AUTO_INCREMENT PRIMARY KEY,
            id_abonnement INT,
            id_annonce INT,
            FOREIGN KEY (id_abonnement) REFERENCES abonnement(id),
            FOREIGN KEY (id_annonce) REFERENCES annonce(id)
        )"
    ];

    // Exécuter chaque requête de création de table
    foreach ($tables as $table) {
        $stmt = $pdo->prepare($table);
        $stmt->execute();
    }
}

?>