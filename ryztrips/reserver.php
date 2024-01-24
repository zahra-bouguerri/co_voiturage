<?php include "./includes/header.php"?>  

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
        .form-container {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .label {
            color: #333;
            font-size: 16px;
            margin-bottom: 5px;
        }
</style>
   
<section class="ftco-section services-section img" style="background-image: url(images/back.avif);">
    <div class="overlay"></div>
    <div class="container" style="max-width: 1500px;"> <!-- Ajustez la valeur selon vos besoins -->
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
            <br />
                <br />
                <h2 class="mb-3">Réserver votre trajet</h2>
               
            </div>
        </div>
    </div>
</section>
<?php



$_SESSION['userId'] = $_GET['userId'];
$_SESSION['trajetId'] = $_GET['trajetId'];

// Récupération des informations du trajet
$trajetId = $_SESSION['trajetId'];
$sql = "SELECT * FROM trajet WHERE id_trajet = $trajetId";
$result = $conn->query($sql);

// Vérification si le formulaire a été soumis
if (isset($_POST['confirmer_reservation'])) {
    // Récupération des valeurs de la session
    $userId = $_SESSION['userId'];
    $trajetId = $_SESSION['trajetId'];

    // Vérifier si la réservation existe déjà pour ce client et ce trajet
    $checkReservationQuery = "SELECT * FROM reservation WHERE id_client = ? AND id_trajet = ?";
    $stmtCheckReservation = $conn->prepare($checkReservationQuery);

    // Vérification de la préparation de la requête
    if ($stmtCheckReservation) {
        // Liaison des paramètres et exécution de la requête
        $stmtCheckReservation->bind_param("ii", $userId, $trajetId);
        $stmtCheckReservation->execute();

        $checkReservationResult = $stmtCheckReservation->get_result();

        if ($checkReservationResult->num_rows > 0) {
            // Une réservation existe déjà, affichez un message d'erreur ou effectuez une action appropriée
            echo "<script>alert('Vous avez déjà réservé ce trajet.'); 
                  window.location.href='index.php?userId=" . $_SESSION['userId']. "';</script>";
        } else {
            // Vérifier si le nombre de places disponibles est supérieur à 0
            $checkPlacesQuery = "SELECT nb_places_dispo FROM trajet WHERE id_trajet = ?";
            $stmtCheckPlaces = $conn->prepare($checkPlacesQuery);

            // Vérification de la préparation de la requête
            if ($stmtCheckPlaces) {
                // Liaison des paramètres et exécution de la requête
                $stmtCheckPlaces->bind_param("i", $trajetId);
                $stmtCheckPlaces->execute();

                $checkPlacesResult = $stmtCheckPlaces->get_result();

                if ($checkPlacesResult->num_rows > 0) {
                    $row = $checkPlacesResult->fetch_assoc();
                    $nbPlacesDispo = $row['nb_places_dispo'];

                    if ($nbPlacesDispo > 0) {
                        // Mettre à jour le nombre de places disponibles dans la table `trajet`
                        $updatePlacesQuery = "UPDATE trajet SET nb_places_dispo = nb_places_dispo - 1 WHERE id_trajet = ?";

                        $stmtUpdatePlaces = $conn->prepare($updatePlacesQuery);

                        // Vérification de la préparation de la requête
                        if ($stmtUpdatePlaces) {
                            // Liaison des paramètres et exécution de la requête
                            $stmtUpdatePlaces->bind_param("i", $trajetId);

                            if ($stmtUpdatePlaces->execute()) {
                                // Insertion de la réservation dans la table `reservation`
                                $insertReservationQuery = "INSERT INTO reservation (id_client, id_trajet) VALUES (?, ?)";
                                $stmtInsertReservation = $conn->prepare($insertReservationQuery);

                                // Vérification de la préparation de la requête
                                if ($stmtInsertReservation) {
                                    // Liaison des paramètres et exécution de la requête
                                    $stmtInsertReservation->bind_param("ii", $userId, $trajetId);

                                    if ($stmtInsertReservation->execute()) {
                                        echo "<script>alert('Réservation réussie !'); 
                                              window.location.href='index.php?userId=" . $_SESSION['userId']. "';</script>";
                                    } else {
                                        echo "Erreur lors de l'exécution de la requête d'insertion de réservation : " . $stmtInsertReservation->error;
                                    }

                                    // Fermeture de la requête préparée
                                    $stmtInsertReservation->close();
                                } else {
                                    echo "Erreur lors de la préparation de la requête d'insertion de réservation : " . $conn->error;
                                }
                            } else {
                                echo "Erreur lors de la mise à jour du nombre de places disponibles : " . $stmtUpdatePlaces->error;
                            }

                            // Fermeture de la requête préparée
                            $stmtUpdatePlaces->close();
                        } else {
                            echo "Erreur lors de la préparation de la requête de mise à jour du nombre de places disponibles : " . $conn->error;
                        }
                    } else {
                        // Le nombre de places disponibles est épuisé, affichez un message d'erreur
                        echo "<script>alert('Désolé, le trajet est complet.'); 
                              window.location.href='index.php?userId=" . $_SESSION['userId']. "';</script>";
                    }
                } else {
                    echo "Erreur lors de la vérification du nombre de places disponibles : " . $stmtCheckPlaces->error;
                }

                // Fermeture de la requête préparée
                $stmtCheckPlaces->close();
            } else {
                echo "Erreur lors de la préparation de la requête de vérification du nombre de places disponibles : " . $conn->error;
            }
        }

        // Fermeture de la requête préparée
        $stmtCheckReservation->close();
    } else {
        echo "Erreur lors de la préparation de la requête de vérification de réservation existante : " . $conn->error;
    }
}
// Affichage des informations dans le tableau
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '
        <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ftco-animate">
                     
                            <table class="table">
                                <thead class="thead-primary">
                                    <tr class="text-center">
                                        <th  class="bg-black heading">Depart</th>
                                        <th  class="bg-black heading">Destination</th>
                                        <th  class="bg-black heading">Date</th>
                                        <th class="bg-black heading">Places disponible</th>
                                        <th class="bg-black heading">Heure de depart</th>
                                        <th class="bg-black heading">Prix</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                    <td class="price">
                                   
                                        <span class="subheading">'  . $row['lieu_depart'] . '  </span>
                                  
                                </td>
                                <td class="price">  
                                    <span class="subheading">'  . $row['destination'] .' </span>

                            </td>
                            <td class="price">
                     
                                <span class="subheading">' . $row['date_trajet'] . '  </span>
                        </td>   
                                        </td>
                                        <td class="price">
                                                <span class="subheading">' . $row['nb_places_dispo'] . ' places </span>
                                        </td>
                                        <td class="price">                   
                                                    <span class="num"><small class="currency"></small> ' . date("h:i a", strtotime($row['heure_depart'])) . '</span>

                                        </td>
                                        <td class="price">
                                                    <span class="num"><small class="currency"></small> ' . $row['prix'] . ' DA</span>
                                                    <span class="per">/par place</span>
                                            </div>
                                        </td>
                                        <td class="price">
                                        <form method="post">
                                        <input type="submit" class="form-control btn btn-primary" name="confirmer_reservation" value="Confirmer">
                                    </form>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
          
                    </div>
                </div>
            </div>
        </section>';
    }
}
$conn->close();
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<?php include "./includes/footer.php";?>

  