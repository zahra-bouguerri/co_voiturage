<?php
// Inclure votre connexion à la base de données ici
include('../config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer la nouvelle valeur de nombre_max depuis le formulaire
    $nouveauNombreMax = $_POST['nouveauNombreMax'];

    // Mettre à jour la valeur de nombre_max dans la table paramètres
    $queryUpdateNombreMax = "UPDATE paramètres SET nombre_max = ? WHERE id_parametre = 1";
    $stmtUpdateNombreMax = $conn->prepare($queryUpdateNombreMax);
    $stmtUpdateNombreMax->bind_param("i", $nouveauNombreMax);

    // Exécuter la requête de mise à jour
    if ($stmtUpdateNombreMax->execute()) {
        echo "<script>alert('La valeur de Nombre Max a été mise à jour avec succès !'); window.location.href='settings.php';</script>";
    } else {
        echo "<script>alert('Erreur lors de la mise à jour de la valeur de Nombre Max !');</script>";
    }

    // Fermer la déclaration préparée de mise à jour
    $stmtUpdateNombreMax->close();
}

// Fermer la connexion à la base de données
$conn->close();
?>
