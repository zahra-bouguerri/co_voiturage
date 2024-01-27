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
$sql = "SELECT * FROM client WHERE nom LIKE '%$search_name%' LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);

// Get the total number of rows in the table
$total_results = mysqli_num_rows($result);

// Calculate the total number of pages
$total_pages = ceil($total_results / $results_per_page);
?>

<?php include "includes/header.php"; ?>
<div class="container">
    <h2>Consulter la Liste des clients</h2>
    <table class="center-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numéro</th>     
                
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) { // Check if query result is valid
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['prenom']; ?></td>
                <td><?php echo $row['adresse_client']; ?></td>
                <td><?php echo $row['numero_tel']; ?></td>
             
            </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='6'>Aucun Client trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <?php include "./includes/pagination.php" ?>

<?php include "./includes/footer.php" ?>