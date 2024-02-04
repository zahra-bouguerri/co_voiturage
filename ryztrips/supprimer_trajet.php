<?php
// Inclure votre connexion à la base de données ici
include('../config/connect.php');

// Vérifier si l'ID du trajet à supprimer est présent dans l'URL
if(isset($_GET['id_trajet'])) {
    // Récupérer l'ID du trajet depuis l'URL
    $id_trajet = $_GET['id_trajet'];

    // Vérifier d'abord s'il existe des réservations liées à ce trajet
    $query_check_reservations = "SELECT COUNT(*) FROM reservation WHERE id_trajet = ?";
    $stmt_check_reservations = $conn->prepare($query_check_reservations);

    if ($stmt_check_reservations) {
        // Lier le paramètre id_trajet à la déclaration préparée
        $stmt_check_reservations->bind_param("i", $id_trajet);

        // Exécuter la requête pour compter les réservations liées
        $stmt_check_reservations->execute();

        // Récupérer le résultat de la requête
        $stmt_check_reservations->bind_result($count_reservations);
        $stmt_check_reservations->fetch();

        // Si des réservations sont trouvées, afficher un message et ne pas supprimer le trajet
        if ($count_reservations > 0) {
            echo "<script>alert('Impossible de supprimer ce trajet car il y a des réservations associées.');
            window.location.href='conducteur.php';</script>";
            exit();
        }
    }

    // Si aucune réservation n'est trouvée, procéder à la suppression du trajet
    $query_delete_trajet = "DELETE FROM Trajet WHERE id_trajet = ?";
    $stmt_delete_trajet = $conn->prepare($query_delete_trajet);

    if ($stmt_delete_trajet) {
        // Lier le paramètre id_trajet à la déclaration préparée
        $stmt_delete_trajet->bind_param("i", $id_trajet);

        // Exécuter la requête pour supprimer le trajet
        $stmt_delete_trajet->execute();

        // Rediriger vers la page de conducteur après la suppression réussie
        header("Location: conducteur.php");
        exit();
    } else {
        // Gérer les erreurs de préparation de la requête pour supprimer le trajet
        echo "<script>alert('Erreur lors de la préparation de la requête pour supprimer le trajet');</script> ";
    }
} else {
    // Rediriger vers la page de liste des trajets si l'ID du trajet n'est pas présent dans l'URL
    header("Location: conducteur.php");
    exit();
}
?>
