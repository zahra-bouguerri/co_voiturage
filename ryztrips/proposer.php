<?php include "./includes/header.php"; 
    

    if (isset($_SESSION['userId'])) {
        $userId = $_SESSION['userId'];
    } elseif (isset($_GET['userId'])) {
        $userId = $_GET['userId'];
    } else {
        echo "<script>alert('Veuillez vous connecter pour accéder au quiz.')</script>";
      
        exit;
    }
  
// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lieu_depart = $_POST["lieu_depart"];
    $lieu_arrivee = $_POST["lieu_arrivee"];

    // Insérer les données dans la base de données - À personnaliser selon votre structure de base de données
    $requete = "INSERT INTO trajet_propose (depart, arrivee) VALUES ('$lieu_depart', '$lieu_arrivee')";

    if ($conn->query($requete) === TRUE) {
        echo "<script>alert('Trajet proposé avec succès');</script>";
 
    } else {
        echo "<script>alert('Erreur lors de la proposition du trajet');</script>";
    
    }
}
?>
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
            <h2 class="mb-3">Proposer vos trajets</h2>
            <span class="subheading">Aidez-nous à ameliorer notre application en proposant vos trajets souhaités</span>
    </br>
    </br>

           
          </div>
        </div>	
    	</div>
    </section>
  
</br>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="form-container">
                <!-- Contenu du formulaire -->
                <section class="ftco-section ftco-no-pb ftco-no-pt">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="request-form ftco-animate">
                        <h2>Proposer un trajet</h2>
                        <div class="form-group">
                            <label for="lieu_depart" class="label">Lieu de départ</label>
                            <input type="text" name="lieu_depart" id="lieu_depart" class="form-control" placeholder="City, Airport, Station, etc" required>
                        </div>
                        <div class="form-group">
                            <label for="lieu_arrivee" class="label">Lieu d'arrivée</label>
                            <input type="text" name="lieu_arrivee" id="lieu_arrivee" class="form-control" placeholder="City, Airport, Station, etc" required>
                        </div>	
                        <div class="form-group">
                            <input type="submit" value="Envoyer" class="form-control btn btn-primary">
                        </div>
                    </form>
    </div>
        </div>
    </div>
    </div>
        <div class="container-fluid">

        <div class="form-container">
    <!-- Contenu du deuxième formulaire -->
    <div class="car-list">
        <h2>Mes reservations </h2>
        <?php
            // Fetch reservations for the current client
// Fetch reservations for the current client
// Fetch reservations for the current client
$query = "SELECT c.numero_tel, t.lieu_depart, t.destination, t.date_trajet, t.heure_depart ,r.id_reservation
          FROM trajet t
          JOIN reservation r ON t.id_trajet = r.id_trajet
          JOIN conducteur c ON t.id_conducteur = c.id_conducteur
          WHERE r.id_client = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>
<?php
if(isset($_GET['delete'])) {
    $code = $_GET['delete'];
    // Use prepared statement with a placeholder for the id value
    $deleteSql = "DELETE FROM reservation WHERE id_reservation = ? ";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("i", $code); // Bind the integer value to the placeholder
    $deleteResult = $stmt->execute(); // Execute the prepared statement

}
?>
        <table class="table">
            <thead class="thead-primary">
                <tr class="text-center">
         
                    <th class="bg-primary heading">Depart</th>
                    <th class="bg-primary heading">Arrivee</th>
                    <th class="bg-dark heading">Date</th>        
                    <th class="bg-dark heading">Heure</th>
                    <th class="bg-dark heading">Numero de conducteur</th>
                    <th class="bg-dark heading">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
 
                  
                    echo "<td>" . $row['lieu_depart'] . "</td>";
                    echo "<td>" . $row['destination'] . "</td>";
                    echo "<td>" . $row['date_trajet'] . "</td>";
                    echo "<td>" . $row['heure_depart'] . "</td>";
                      echo "<td>0" . $row['numero_tel'] . "</td>";?>
                 <td>
    <a href="?delete=<?php echo $row['id_reservation']; ?>" onclick="return confirm('Vous êtes sûr d\'annuler cette réservation?')">
        <ion-icon name="trash-outline">Annuler</ion-icon>
    </a>
</td>

                   <?php echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
    </div>
    </div>
    </section>
         
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<?php include "./includes/footer.php";?>

  