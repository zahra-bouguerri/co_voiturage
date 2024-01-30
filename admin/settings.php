<?php
include('../config/connect.php');
?>
<?php include "includes/header.php"; ?>
<style>
  /* Styles personnalisés pour le conteneur */
  .r {
    margin-left: auto; /* Marge à gauche automatique pour décaler vers la droite */
    max-width: 1000px; /* Largeur maximale du conteneur */
    padding: 30px; /* Espacement intérieur */
    
    border-radius: 10px; /* Coins arrondis */
    
  }
</style>

<div class="container ml-auto">
    <div class="r">
  <h3 class="mt-4 mb-4">Modifier Nombre de place au maximum pour les trajets </h3>
</br>

  <?php
  // Inclure votre connexion à la base de données ici
  include('../config/connect.php');

  // Récupérer la valeur actuelle de nombre_max
  $queryNombreMax = "SELECT nombre_max FROM paramètres WHERE id_parametre = 1";
  $resultNombreMax = $conn->query($queryNombreMax);

  if ($resultNombreMax) {
    $rowNombreMax = $resultNombreMax->fetch_assoc();
    $nombreMaxActuel = $rowNombreMax['nombre_max'];

    
  } else {
    echo "<p>Erreur lors de la récupération de la valeur actuelle de Nombre Max.</p>";
  }

  // Fermer le résultat de la requête pour obtenir nombre_max
  $resultNombreMax->close();
  ?>

  <form action="modifier_nombre_max.php" method="post">
    <div class="form-group">
     
    <input type="number" class="form-control text-muted" id="nouveauNombreMax" name="nouveauNombreMax" value="<?php echo $nombreMaxActuel; ?>" required>

    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
  </form>
    </div>
</div>
<div id="bingMap" style="position:relative;height:400px;"></div>
<script type='text/javascript' src='https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&s=1'></script>
<script type='text/javascript'>
        var map, mapOptions; 
        var pinInfobox = null;

        function init() {
            mapOptions = {
                credentials: 'AoiyGy03-LqmZBoXyAArp6u-Rt9nobOLSDd5YoZ6lA1VD9IykV4v1F45td0Yw4Zs',
                center: new Microsoft.Maps.Location(58.995311, -103.535156),
                zoom: 3,
                mapTypeId: Microsoft.Maps.MapTypeId.road
            };

            map = new Microsoft.Maps.Map(document.getElementById("bingMap"), mapOptions);
            Microsoft.Maps.Events.addHandler(map, 'click', getLatlng);

            // Request the user's location
            navigator.geolocation.getCurrentPosition(function (position) {
                var loc = new Microsoft.Maps.Location(
                    position.coords.latitude,
                    position.coords.longitude);

                // Add a pushpin at the user's location.
                var pin = new Microsoft.Maps.Pushpin(loc);
                map.entities.push(pin);

                // Center the map on the user's location.
                map.setView({ center: loc, zoom: 15 });
            });
            <?php
$sql = "SELECT * FROM trajet";
$result = $conn->query($sql);

// Vérifier s'il y a des erreurs dans la requête SQL
if (!$result) {
    die("Erreur dans la requête SQL : " . $conn->error);
}

// Parcourir les résultats et afficher les trajets sur la carte
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "addTrajetToMap('" . $row['lieu_depart'] . "', '" . $row['destination'] . "');\n";
    }
} else {
    echo "Aucun trajet trouvé dans la base de données.";
}

// Fermer la connexion à la base de données
$conn->close();
?>
        }
        
        function addTrajetToMap(lieuDepart, destination) {
    // Fonction pour géocoder une adresse et renvoyer les coordonnées
    function geocodeAddress(address) {
        return new Promise(function (resolve, reject) {
            var geocodeRequest = "https://dev.virtualearth.net/REST/v1/Locations?query=" + address + "&key=" + mapOptions.credentials;

            Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
                var searchManager = new Microsoft.Maps.Search.SearchManager(map);

                searchManager.geocode({
                    where: address,
                    callback: function (geocodeResult, userData) {
                        if (geocodeResult && geocodeResult.results && geocodeResult.results.length > 0) {
                            var location = geocodeResult.results[0].location;
                            resolve(location);
                        } else {
                            reject("Erreur de géocodage pour l'adresse : " + address);
                        }
                    }
                });
            });
        });
    }

    var lieuDepartCoord; // Déclarer lieuDepartCoord en dehors des promesses

    // Géocoder le lieu de départ
    geocodeAddress(lieuDepart)
        .then(function (location) {
            lieuDepartCoord = location; // Assigner la valeur à lieuDepartCoord

            // Ajouter un pushpin pour le lieu de départ (départ)
            var pushpinDepart = new Microsoft.Maps.Pushpin(lieuDepartCoord, {
                color: 'green', // Couleur du pushpin pour le lieu de départ
                title: 'Départ'
            });

            // Ajouter une infobox avec le nom du lieu de départ
            pushpinDepart.metadata = {
                title: 'Départ',
                description: lieuDepart
            };

            Microsoft.Maps.Events.addHandler(pushpinDepart, 'click', displayInfobox);

            map.entities.push(pushpinDepart);

            // Géocoder la destination
            return geocodeAddress(destination);
        })
        .then(function (destinationCoord) {
            // Ajouter un pushpin pour la destination (arrivée)
            var pushpinArrivee = new Microsoft.Maps.Pushpin(destinationCoord, {
                color: 'red', // Couleur du pushpin pour la destination
                title: 'Arrivée'
            });

            // Ajouter une infobox avec le nom du lieu d'arrivée
            pushpinArrivee.metadata = {
                title: 'Arrivée',
                description: destination
            };

            Microsoft.Maps.Events.addHandler(pushpinArrivee, 'click', displayInfobox);

            map.entities.push(pushpinArrivee);

            // Créer une ligne entre le lieu de départ et la destination en rouge
            var trajetLine = new Microsoft.Maps.Polyline([lieuDepartCoord, destinationCoord], {
                strokeColor: 'blue',
                strokeThickness: 2
            });
            map.entities.push(trajetLine);
        })
        .catch(function (error) {
            alert(error);
        });
}

// Fonction pour afficher l'infobox au clic sur le pushpin
function displayInfobox(e) {
    if (e.target.metadata) {
        var infobox = new Microsoft.Maps.Infobox(e.target.getLocation(), {
            title: e.target.metadata.title,
            description: e.target.metadata.description,
            visible: true
        });
        map.entities.push(infobox);
    }
}


        function getLatlng(e) { 
            if (e.targetType == "map") {
                var point = new Microsoft.Maps.Point(e.getX(), e.getY());
                var locTemp = e.target.tryPixelToLocation(point);
                var location = new Microsoft.Maps.Location(locTemp.latitude, locTemp.longitude);

                var pin = new Microsoft.Maps.Pushpin(location, {'draggable': false});

                map.entities.push(pin);
            }
        }

        // Call the init function when the page is loaded
        window.onload = init;
    </script>


<?php include "./includes/footer.php" ?>
