<?php
// Inclure votre connexion à la base de données ici
include('../config/connect.php');

// Vérifier si l'ID du trajet à supprimer est présent dans l'URL
if(isset($_GET['id_trajet'])) {
    // Récupérer l'ID du trajet depuis l'URL
    $id_trajet = $_GET['id_trajet'];

    // Préparer la requête SQL pour supprimer le trajet
    $query = "DELETE FROM Trajet WHERE id_trajet = ?";

    $stmt = $conn->prepare($query);

    if ($stmt) {
        // Lier le paramètre id_trajet à la déclaration préparée
        $stmt->bind_param("i", $id_trajet);

        // Exécuter la requête
        $stmt->execute();

        header("Location: conducteur.php");
        exit();
    } else {
        // Gérer les erreurs de préparation de la requête
        echo "Erreur lors de la préparation de la requête : " . $conn->error;
    }

} else {
    // Rediriger vers la page de liste des trajets si l'ID du trajet n'est pas présent dans l'URL
    header("Location: conducteur.php");
    exit();
}

?>
