<?php
include('../config/connect.php');

// Vérifie si le formulaire a été soumis
$role = $_SESSION['role'];
if (isset($_POST['btnr'])) {
    // Récupère les informations soumises par le formulaire
    $depart = $_POST['depart'];
    $destination = $_POST['destination'];
    $dateFormulaire = $_POST['date'];
    

    // Convertir le format de date
    $date = DateTime::createFromFormat('m/d/Y', $dateFormulaire);
    $dateFormatee = $date->format('Y-m-d');
    $userId = isset($_POST['userId']) ? $_POST['userId'] : null;
    // Échappe les valeurs pour éviter les injections SQL (optionnel mais recommandé)
    $depart = mysqli_real_escape_string($conn, $depart);
    $destination = mysqli_real_escape_string($conn, $destination);
    $dateFormatee = mysqli_real_escape_string($conn, $dateFormatee);
  

    // Requête SQL pour récupérer les trajets filtrés
    $query = "SELECT * FROM trajet WHERE lieu_depart = '$depart' AND destination = '$destination' AND date_trajet = '$dateFormatee' ";

    

    
    
    $result = mysqli_query($conn, $query);

    // Vérifie s'il y a des résultats
    if ($result) {
        // Affiche le tableau des trajets
        include "./includes/header.php";
        ?>
        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/image_6.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                    <div class="col-md-9 ftco-animate pb-5">
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Pricing <i class="ion-ios-arrow-forward"></i></span></p>
                        <h1 class="mb-3 bread">Trajets</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                        <div class="car-list">
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                    <th class="bg-primary heading">Départ</th>
            <th class="bg-dark heading">Arrivée</th>
            <th class="bg-dark heading">Date</th>
            <th class="bg-black heading">Heure</th>
            <th class="bg-black heading">Prix</th>
            <th class="bg-primary heading">Réserver</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td class='price'><p class='btn-custom'><a href='#'>Rent a car</a></p><div class='price-rate'><span class='subheading'>" . $row['lieu_depart'] . "</span></div></td>";
            echo "<td class='price'><p class='btn-custom'><a href='#'>Rent a car</a></p><div class='price-rate'><span class='subheading'>" . $row['destination'] . "</span></div></td>";
            echo "<td class='price'><p class='btn-custom'><a href='#'>Rent a car</a></p><div class='price-rate'><span class='subheading'>" . $row['date_trajet'] . "</span></div></td>";
            echo "<td class='price'><p class='btn-custom'><a href='#'>Rent a car</a></p><div class='price-rate'><span class='subheading'>" . $row['heure_depart'] . "</span></div></td>";
            echo "<td class='price'><p class='btn-custom'><a href='#'>Rent a car</a></p><div class='price-rate'><h3><span class='num'><small class='currency'></small>" . $row['prix'] . " DA</span></h3></div></td>";
            echo "<td>";
            if ($role == 'conducteur') {
                echo "<p>En tant que conducteur, vous ne pouvez pas réserver de trajet.</p>";
            } else {
                $reservationLink = "reserver.php?userId=" . $userId . "&trajetId=" . $row['id_trajet'];
                echo "<button type='button' class='btn btn-primary' title='Réserver' onclick=\"window.location.href='" . $reservationLink . "'\"><i class='fas fa-car'></i></button>";
            }
            echo "</td>";
            echo "</tr>";
        }
        ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
        include "./includes/footer.php";
    } else {
        echo "Erreur dans la requête : " . mysqli_error($conn);
    }

    // Libère la mémoire associée au résultat
    mysqli_free_result($result);

    // Ferme la connexion à la base de données
    mysqli_close($conn);
} else {
    // Redirige si le formulaire n'a pas été soumis
    header("Location: index.php");
    exit();
}
?>
