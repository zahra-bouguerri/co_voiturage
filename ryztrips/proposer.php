<?php include "./includes/header.php"?>  
<?php
// Informations de connexion à la base de données
$host = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "covoiturage"; 

// Tentative de connexion à la base de données
$conn = new mysqli($host, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $lieu_depart = $_POST["lieu_depart"];
    $lieu_arrivee = $_POST["lieu_arrivee"];

    // Insérer les données dans la base de données - À personnaliser selon votre structure de base de données
    $requete = "INSERT INTO trajet_propose (depart, arrivee) VALUES ('$lieu_depart', '$lieu_arrivee')";

    if ($conn->query($requete) === TRUE) {
        echo "Trajet proposé avec succès.";
    } else {
        echo "Erreur lors de la proposition du trajet : " . $conn->error;
    }
}

?>
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
                </section>
            </div>
        </div>
    </div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<?php include "./includes/footer.php";?>

  