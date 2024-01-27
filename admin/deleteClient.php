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


// Execute the SQL query and store the result in $result variable
$sql = "SELECT * FROM client WHERE nom LIKE '%$search_name%' LIMIT $results_per_page OFFSET $offset";
$result = $conn->query($sql);

// Get the total number of rows in the table
$total_results = mysqli_num_rows($result);

// Calculate the total number of pages
$total_pages = ceil($total_results / $results_per_page);

if(isset($_GET['delete'])) {
    $code = $_GET['delete'];
    // Use prepared statement with a placeholder for the id value
    $deleteSql = "DELETE FROM client WHERE id_client = ?";
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $code); // Bind the integer value to the placeholder
    $deleteResult = $stmt->execute(); // Execute the prepared statement
    if($deleteResult) {
        header("Refresh:0; url=./deleteClient.php");
    }
}
?>

<?php include "includes/header.php"; ?>
<div class="container">
    <h2>Supprimer un Client</h2>
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
                <td><a href="?delete=<?php echo $row['id_client']; ?>" onclick="return confirm('Vous etes sure de supprimer ce client?')"><ion-icon name="trash-outline"></ion-icon></a></td> 
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
