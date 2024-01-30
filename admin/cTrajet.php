<?php
include('../config/connect.php');

// Number of results to display per page
$results_per_page = 8;
// Get the current page number
if (!isset($_GET['page'])) {
    $current_page = 1;
} else {
    $current_page = $_GET['page'];
}
// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $results_per_page;

// Get the search input value
$search_name = isset($_GET['titre']) ? $_GET['titre'] : '';


$sql = "SELECT *, conducteur.nom 
        FROM trajet 
        INNER JOIN conducteur ON trajet.id_conducteur = conducteur.id_conducteur 
        WHERE lieu_depart LIKE '%$search_name%' 
        LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);


// Get the total number of rows in the table
$total_results = mysqli_num_rows($result);

// Calculate the total number of pages
$total_pages = ceil($total_results / $results_per_page);
?>
<?php include "includes/header.php"; ?>


<div class="container" style="max-height: 700px; overflow-y: auto;">
    <h2>Consulter la Liste des Trajets</h2>
    <table class="center-table">
        <thead>
            <tr>
                <th>Nom conducteur</th>
                <th>Lieu Depart</th>
                <th>Destination</th>
                <th>Date</th>
                <th>Heure</th>    
                <th>Nb_Place</th> 
                <th>Prix</th>  
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['lieu_depart']; ?></td>
                <td><?php echo $row['destination']; ?></td>
                <td><?php echo $row['date_trajet']; ?></td>
                <td><?php echo $row['heure_depart']; ?></td>
                <td><?php echo $row['nb_places_dispo']; ?></td>
                <td><?php echo $row['prix']; ?></td>
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>Aucun Trajet trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <?php include "./includes/pagination.php" ?>
        </br>

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
        $lieuDepart = htmlspecialchars($row['lieu_depart']);
        $destination = htmlspecialchars($row['destination']);
        $dateDepart = htmlspecialchars($row['date_trajet']);
        $heureDepart = htmlspecialchars($row['heure_depart']);

        echo "addTrajetToMap('" . $lieuDepart . "', '" . $destination . "', '" . $dateDepart . "', '" . $heureDepart . "' );\n";
    }
} else {
    echo "Aucun trajet trouvé dans la base de données.";
}

// Fermer la connexion à la base de données
$conn->close();
?>


        }
        
        function addTrajetToMap(lieuDepart, destination, dateDepart, heureDepart) {
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
                description: lieuDepart + '<br>Date de départ<br> : ' + dateDepart + '<br>Heure de départ<br>: ' + heureDepart
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


</div>

<?php include "./includes/footer.php" ?>

