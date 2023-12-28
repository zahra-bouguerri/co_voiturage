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

    <section class="ftco-section services-section img" style="background-image: url(images/conducteur.avif);">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
</br></br>
          
</br>
            <h2 class="mb-3">Conducteur</h2>
            <span class="subheading">gerer vos trajets facilement et gagner beaucoup de clients</span>
    </br>
    </br>

            <h1 class="subheading">Liste de mes trajets</h1>
          </div>
        </div>	
    	</div>
    </section>



	<?php
// Inclure votre connexion à la base de données ici

// Récupérer l'ID du conducteur (vous devrez ajuster selon votre logique d'authentification)
$id_conducteur = 1; // Remplacez ceci par la logique appropriée pour obtenir l'ID du conducteur actuel

// Préparer la requête SQL pour récupérer les données des trajets
$query = "SELECT * FROM Trajet WHERE id_conducteur = ?";

// Utiliser une déclaration préparée pour éviter les injections SQL
$stmt = $conn->prepare($query);

// Vérifier si la préparation de la requête a réussi
if ($stmt) {
    // Lier le paramètre id_conducteur à la déclaration préparée
    $stmt->bind_param("i", $id_conducteur);

    // Exécuter la requête
    $stmt->execute();

    // Récupérer les résultats de la requête
    $result = $stmt->get_result();

    // Afficher le début du tableau HTML
    echo '
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
            <tbody>';

    // Traiter les résultats
    while ($row = $result->fetch_assoc()) {
        // Afficher les données dans le tableau HTML
        echo '
        <tr>
            <td class="price">
                <p class="btn-custom"><a href="#">Rent a car</a></p>
                <div class="price-rate">
                    <span class="subheading">' . $row['lieu_depart'] . '</span>
                </div>
            </td>
            <td class="price">
                <p class="btn-custom"><a href="#">Rent a car</a></p>
                <div class="price-rate">
                    <span class="subheading">' . $row['destination'] . '</span>
                </div>
            </td>
            <td class="price">
                <p class="btn-custom"><a href="#">Rent a car</a></p>
                <div class="price-rate">
                    <span class="subheading">' . $row['date_trajet'] . '</span>
                </div>
            </td>
            <td class="price">
                <p class="btn-custom"><a href="#">Rent a car</a></p>
                <div class="price-rate">
                    <span class="subheading">' . $row['heure_depart'] . '</span>
                </div>
            </td>
            <td class="price">
                <p class="btn-custom"><a href="#">Rent a car</a></p>
                <div class="price-rate">
                    <h3><span class="num"><small class="currency"></small>' . $row['prix'] . '</span></h3>
                </div>
            </td>
            <td class="price">
        <button type="button" class="btn btn-primary" title="Modifier" onclick="window.location.href=\'modifier_trajet.php?id_trajet=' . $row['id_trajet'] . '\'">
            <i class="fas fa-pencil-alt"></i>
        </button>
        <button type="button" class="btn btn-danger" title="Supprimer" onclick="confirmerSuppression(' . $row['id_trajet'] . ')">
            <i class="fas fa-trash"></i>
        </button>
    </td>';
    }

    // Afficher la fin du tableau HTML
    echo '
            </tbody>
        </table>
    </div>';
	
	echo '
<script>
function confirmerSuppression(id_trajet) {
    if (confirm("Voulez-vous vraiment supprimer ce trajet ?")) {
        window.location.href = \'supprimer_trajet.php?id_trajet=\' + id_trajet;
    }
}
</script>';
    // Fermer la déclaration préparée et le résultat
    $stmt->close();
    $result->close();
} else {
    // Gérer les erreurs de préparation de la requête
    echo "Erreur lors de la préparation de la requête : " . $conn->error;
}

?>

</br>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="form-container">
                <!-- Contenu du premier formulaire -->
                <section class="ftco-section ftco-no-pb ftco-no-pt">
                    <form action="ajouter_trajet.php" method="post" class="request-form ftco-animate">
                        <h2>Creer un trajet</h2>
                        <div class="form-group">
                            <label for="" class="label">Lieu de départ</label>
                            <input type="text" class="form-control"  name ="depart" placeholder="City, Airport, Station, etc">
                        </div>
                        <div class="form-group">
                            <label for="" class="label">Lieu d'arivée</label>
                            <input type="text" class="form-control" name="destination" placeholder="City, Airport, Station, etc">
                        </div>
                        <div class="form-group">
                            <label for="" class="label">Nombre de place</label>
                            <input type="number" class="form-control" name="nb_places" placeholder="Nombre de places disponible">
                        </div>
                        <div class="form-group">
                            <label for="" class="label">Prix</label>
                            <input type="text" class="form-control"name="prix" placeholder="500 DA">
                        </div>
		        		<div class="form-group">
		        					<label for="" class="label">date de départ </label>
		        					
										<input type="date" class="form-control" name="date" id="book_pick_date">
			            </div>
                        <div class="form-group">
		        					<label for="" class="label">Heure de départ </label>
		        					
                                    <input type="time"name ="heure"  class="form-control" id="book_pick_time">
			             </div>
		        			
                        <!-- Autres champs du formulaire... -->
                        <div class="form-group">
                        <input type="submit" name="ajouter" value="Publier" class="form-control btn btn-primary" >
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-container">
                <!-- Contenu du deuxième formulaire -->
               
                <div class="car-list">
    <h2>Trajet proposé par les clients</h2>
    <table class="table">
        <thead class="thead-primary">
            <tr class="text-center">
                <th class="bg-primary heading">Départ</th>
                <th class="bg-dark heading">Arrivée</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming $conn is your database connection
            $query = "SELECT depart, arrivee FROM trajet_propose";
            $result = mysqli_query($conn, $query);

            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>
                            <td class="price">
                                <span class="subheading">' . htmlspecialchars($row['depart']) . '</span>
                            </td>
                            <td class="price">
                                <span class="subheading">' . htmlspecialchars($row['arrivee']) . '</span>
                            </td>
                          </tr>';
                }
            } else {
                echo 'Error executing query: ' . mysqli_error($conn);
            }

            ?>
        </tbody>
    </table>
</div>
            </div>
        </div>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<?php include "./includes/footer.php";?>

  