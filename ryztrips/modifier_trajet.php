<?php
include "./includes/header.php";

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
        echo "<script>alert('Mise a jour effectue !'); window.location.href='conducteur.php?id=" . $_SESSION['userId'] . "';</script>";
    
    } else {
        echo "Erreur lors de la mise à jour du trajet.";
    }
}

?>

<!-- Formulaire de modification de trajet -->
<section class="ftco-section services-section img" style="background-image: url(images/conducteur.avif);">
    
    	<div class="container">
    		<div class="row justify-content-center mb-5">

        </div>	
    	</div>
    </section>

    <form method="POST" action="">
    <div class="car-list">
        <table class="table">
            <thead class="thead-primary">
                <tr class="text-center">
                    <th class="bg-primary heading">Départ</th>
                    <th class="bg-dark heading">Arrivée</th>
                    <th class="bg-dark heading">Date</th>
                    <th class="bg-black heading">Heure</th>
                    <th class="bg-black heading">Prix</th>
                    <th class="bg-black heading">Actions</th>
                </tr>
            </thead>
            <tbody>

        <tr>
            <td class="price">
                <input type="text" name="nouveau_lieu_depart" value="<?php echo $trajetDetails['lieu_depart']; ?>" required>
            </td>
            <td class="price">
                <input type="text"  name="nouvelle_destination" value="<?php echo $trajetDetails['destination']; ?>" required>
            </td>
            <td class="price">

                <input type="date"  name="nouvelle_date_trajet" value="<?php echo $trajetDetails['date_trajet']; ?>" required>

            </td>
            <td>
                <input type="time" name="nouvelle_heure_depart" value="<?php echo $trajetDetails['heure_depart']; ?>" required>
     
            </td>
            <td class="price">
                <input type="number"   name="nouveau_prix" value="<?php echo $trajetDetails['prix']; ?>" required>
            </td>
            <td> <button type="submit" class="btn btn-primary" name="modifier_trajet"> Sauvegarder </button>
        </td>
        </tr>
            </tbody>
        </table>
    </div>  
    </form>

