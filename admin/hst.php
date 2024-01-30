 
<?php
include('../config/connect.php');

// Number of results to display per page
$results_per_page = 9;
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

//  the SQL query 
$sql = "SELECT * FROM historique_trajet WHERE lieu_depart LIKE '%$search_name%' LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);

// Get the total number of rows in the table
$total_results = mysqli_num_rows($result);

// Calculate the total number of pages
$total_pages = ceil($total_results / $results_per_page);
?>

<?php include "includes/header.php"; ?>
<div class="container">
    <h2>Consulter l'historique des trajets</h2>
    <table class="center-table">
        <thead>
            <tr>
                <th>ID Trajet</th>
                <th>ID Conducteur</th>
                <th>ID Client</th>
                <th>Lieu de départ</th>
                <th>Destination</th>
                <th>Date de trajet</th>
                <th>Heure de départ</th>
                <th>Nombre de places disponibles</th>
                <th>Prix</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assurez-vous que $result est une requête valide sur la table historique_trajet
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id_historique_trajet']; ?></td>
                <td><?php echo $row['id_conducteur']; ?></td>
                <td><?php echo $row['id_client']; ?></td>
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
                echo "<tr><td colspan='9'>Aucun trajet trouvé dans l'historique</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

    <?php include "./includes/pagination.php" ?>

<?php include "./includes/footer.php" ?>