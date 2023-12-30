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
session_start();
$_SESSION['userId'] = $_GET['userId'];
$_SESSION['trajetId'] = $_GET['trajetId'];


// Récupération des informations du trajet
$trajetId = $_SESSION['trajetId'];
$sql = "SELECT * FROM trajet WHERE id_trajet = $trajetId";
$result = $conn->query($sql);

// Affichage des informations dans le tableau
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="car-list">
                        <table class="table">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th class="bg-primary heading">nombre de places disponible</th>
                                    <th class="bg-dark heading">heure de depart</th>
                                    <th class="bg-black heading">Prix</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="car-image"><div class="img" style="background-image:url(images/car-1.jpg);"></div></td>
                                    <td class="product-name">
                                        <h3><?php echo $row['lieu_depart'] . ' -- ' . $row['destination']; ?></h3>
                                        <p class="mb-0 rated">
                                            le <?php echo $row['date_trajet']; ?>
                                        </p>
                                    </td>
                                    <td class="price">
                                        <div class="price-rate">
                                            <span class="subheading"><?php echo $row['nb_places_dispo']; ?> places </span>
                                        </div>
                                    </td>
                                    <td class="price">
                                        <p class="btn-custom"><a href="#">Rent a car</a></p>
                                        <div class="price-rate">
                                            <h3>
                                                <span class="num"><small class="currency"></small> <?php echo date("h:i a", strtotime($row['heure_depart'])); ?></span>
                                            </h3>
                                        </div>
                                    </td>
                                    <td class="price">
                                        <div class="price-rate">
                                            <h3>
                                                <span class="num"><small class="currency"></small> <?php echo $row['prix']; ?> DA</span>
                                                <span class="per">/par place</span>
                                            </h3>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <input type="button" value="confirmer la reservation" class="form-control btn btn-primary">
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
    }
} else {
    echo '<p>No data available.</p>';
}

// Fermeture de la connexion
$conn->close();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<?php include "./includes/footer.php";?>

  