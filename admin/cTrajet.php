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
<div class="container">
    <h2>Consulter la Liste des Trajets</h2>
    <table class="center-table">
        <thead>
            <tr>
                 <th> Nom conducteur</th>
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
            if ($result && mysqli_num_rows($result) > 0) { // Check if query result is valid
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

<?php include "./includes/footer.php" ?>