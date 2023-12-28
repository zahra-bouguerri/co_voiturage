<?php
ob_start();
include('../config/connect.php');

// Fonction pour récupérer les détails du trajet
function getTrajetDetails($id_trajet, $conn)
{
    $sql = "SELECT * FROM trajet WHERE id_trajet = $id_trajet";
    $result = mysqli_query($conn, $sql);

    return ($result) ? mysqli_fetch_assoc($result) : null;
}

if (isset($_GET['id_trajet'])) {
    $id_trajet = $_GET['id_trajet'];
    $trajetDetails = getTrajetDetails($id_trajet, $conn);

    // Vérifier si le trajet existe
    if (!$trajetDetails) {
        echo "Trajet non trouvé.";
        exit;
    }
} else {
    echo "ID du trajet non spécifié.";
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier_trajet"])) {
    // Récupérer les nouvelles valeurs du formulaire
    $nouveau_lieu_depart = $_POST["nouveau_lieu_depart"];
    $nouvelle_destination = $_POST["nouvelle_destination"];
    $nouvelle_date_trajet = $_POST["nouvelle_date_trajet"];
    $nouvelle_heure_depart = $_POST["nouvelle_heure_depart"];
    $nouveau_prix = $_POST["nouveau_prix"];

    // Préparer la requête SQL pour la mise à jour
    $updateTrajetQuery = "UPDATE trajet SET lieu_depart = ?, destination = ?, date_trajet = ?, heure_depart = ?, prix = ? WHERE id_trajet = ?";
    $stmt = mysqli_prepare($conn, $updateTrajetQuery);

    // Liaison des paramètres
    mysqli_stmt_bind_param($stmt, "ssssdi", $nouveau_lieu_depart, $nouvelle_destination, $nouvelle_date_trajet, $nouvelle_heure_depart, $nouveau_prix, $id_trajet);

    // Exécution de la requête
    $success = mysqli_stmt_execute($stmt);

    // Fermeture de la requête préparée
    mysqli_stmt_close($stmt);

    // Redirection vers la page de gestion des trajets
    if ($success) {
        header("Location: conducteur.php");
        exit;
    } else {
        echo "Erreur lors de la mise à jour du trajet.";
    }
}

ob_end_flush();
?>

<!-- Formulaire de modification de trajet -->
<div class="car-list">
    <form method="POST" action="">
        <!-- Ajoutez ici les champs du formulaire pour les valeurs actuelles du trajet -->
        <label for="nouveau_lieu_depart">Nouveau lieu de départ:</label>
        <input type="text" name="nouveau_lieu_depart" value="<?php echo $trajetDetails['lieu_depart']; ?>" required><br>

        <label for="nouvelle_destination">Nouvelle destination:</label>
        <input type="text" name="nouvelle_destination" value="<?php echo $trajetDetails['destination']; ?>" required><br>

        <label for="nouvelle_date_trajet">Nouvelle date du trajet:</label>
        <input type="date" name="nouvelle_date_trajet" value="<?php echo $trajetDetails['date_trajet']; ?>" required><br>

        <label for="nouvelle_heure_depart">Nouvelle heure de départ:</label>
        <input type="time" name="nouvelle_heure_depart" value="<?php echo $trajetDetails['heure_depart']; ?>" required><br>

        <label for="nouveau_prix">Nouveau prix:</label>
        <input type="number" name="nouveau_prix" value="<?php echo $trajetDetails['prix']; ?>" required><br>

        <button type="submit" name="modifier_trajet">Modifier le trajet</button>
    </form>
</div>
