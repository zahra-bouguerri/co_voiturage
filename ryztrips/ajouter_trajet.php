<?php
// Inclure votre connexion à la base de données ici
include('../config/connect.php');

if (isset($_POST['ajouter'])) {
    // Récupérer les données du formulaire
    $depart = $_POST['depart'];
    $destination = $_POST['destination'];
    $nb_places = $_POST['nb_places'];
    $prix = $_POST['prix'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];

    // Récupérer les données du conducteur (vous devrez ajuster selon votre logique d'authentification)
    $id_conducteur = 1; // Remplacez ceci par la logique appropriée pour obtenir l'ID du conducteur actuel

    // Préparer la requête SQL d'insertion dans la table Trajet
    $query = "INSERT INTO Trajet (lieu_depart, destination, nb_places_dispo, prix, date_trajet, heure_depart, id_conducteur) VALUES (?, ?, ?, ?, ?, ?, ?)";

    // Utiliser une déclaration préparée pour éviter les injections SQL
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssidsii", $depart, $destination, $nb_places, $prix, $date, $heure, $id_conducteur);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Le trajet a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du trajet : " . $stmt->error;
    }

    // Fermer la déclaration préparée
    $stmt->close();
}

// Fermer la connexion à la base de données
$conn->close();
?>
