<?php

// Informations de connexion à la base de données
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "covoiturage"; 

session_start();
// Tentative de connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Vous êtes maintenant connecté à la base de données. Vous pouvez utiliser la variable $conn pour exécuter des requêtes SQL.

?>
