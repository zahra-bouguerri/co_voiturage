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

if (isset($_SESSION['userId'])) {
    $userId = $_SESSION['userId'];
} elseif (isset($_GET['userId'])) {
    $userId = $_GET['userId'];
} else {
    echo "<script>alert('Veuillez vous connecter pour accéder au quiz.')</script>";
    exit;
}

// Use a prepared statement to avoid SQL injection
$query = "SELECT * FROM Trajet WHERE id_conducteur = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    // Bind the parameter
    $stmt->bind_param("i", $userId);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows in the result
    if ($result->num_rows > 0) {
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

        // Process the results
        while ($row = $result->fetch_assoc()) {
            echo '
            <tr>
                <td class="price">
                    <div class="price-rate">
                        <span class="subheading">' . htmlspecialchars($row['lieu_depart']) . '</span>
                    </div>
                </td>
                <td class="price">
                    <div class="price-rate">
                        <span class="subheading">' . htmlspecialchars($row['destination']) . '</span>
                    </div>
                </td>
                <td class="price">
                    <div class="price-rate">
                        <span class="subheading">' . htmlspecialchars($row['date_trajet']) . '</span>
                    </div>
                </td>
                <td class="price">
                    <div class="price-rate">
                        <span class="subheading">' . htmlspecialchars($row['heure_depart']) . '</span>
                    </div>
                </td>
                <td class="price">
                    <div class="price-rate">
                        <h3><span class="num"><small class="currency"></small>' . htmlspecialchars($row['prix']) . '</span></h3>
                    </div>
                </td>
                <td class="price">
                    <button type="button" class="btn btn-primary" title="Modifier" onclick="window.location.href=\'modifier_trajet.php?id_trajet=' . $row['id_trajet'] . '\'">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <button type="button" class="btn btn-danger" title="Supprimer" onclick="confirmerSuppression(\'' . $row['id_trajet'] . '\')">
                    <i class="fas fa-trash"></i>
                </button>
                </td>
            </tr>';
        }

        echo '
                </tbody>
            </table>
        </div>';
    } else {
        echo '<p class="text-center">Vous aucun trajet pour le moment.</p>';
    }

    echo '
<script>
function confirmerSuppression(id_trajet) {
    if (confirm("Voulez-vous vraiment supprimer ce trajet ?")) {
        window.location.href = \'supprimer_trajet.php?id_trajet=\' + id_trajet;
    }
}
</script>';

    $stmt->close();
    $result->close();
} else {
 
    echo "Erreur lors de la préparation de la requête : " . $conn->error;
}

?>


</br>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="form-container">
            
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
		        					
										<input type="text" class="form-control" name="date" id="book_pick_date">
			            </div>
                        <div class="form-group">
		        					<label for="" class="label">Heure de départ </label>
		        					
                                    <input type="time" name ="heure"  class="form-control" id="book_pick_time">
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
    <div >
    <div class="form-container">
    <!-- Contenu du deuxième formulaire -->
    <div class="car-list">
        <h2>Les reservations des clients</h2>
        <?php
            // Fetch reservations for the current client
    $query = "SELECT c.nom, c.prenom, c.numero_tel, t.lieu_depart, t.destination, t.date_trajet, t.heure_depart 
              FROM reservation r
              JOIN client c ON r.id_client = c.id_client
              JOIN trajet t ON r.id_trajet = t.id_trajet
              WHERE t.id_conducteur = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

        ?>
        <table class="table">
            <thead class="thead-primary">
                <tr class="text-center">
                    <th class="bg-primary heading">Nom</th>
                    <th class="bg-dark heading">Prenom</th>
                    <th class="bg-dark heading">Numero</th>
                    <th class="bg-dark heading">Depart</th>
                    <th class="bg-dark heading">Arrivee</th>
                    <th class="bg-dark heading">Date</th>
                    <th class="bg-dark heading">Heure</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['prenom'] . "</td>";
                    echo "<td>" . $row['numero_tel'] . "</td>";
                    echo "<td>" . $row['lieu_depart'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['date_trajet'] . "</td>";
                    echo "<td>" . $row['heure_depart'] . "</td>";
                    echo "</tr>";
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

  