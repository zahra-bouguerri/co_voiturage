<?php
// Include your database connection file
include('../config/connect.php');

// Check if the reservation ID is provided in the query parameter
if(isset($_GET['id_reservation'])) {
    $reservation_id = $_GET['id_reservation'];

    // Write your SQL query to delete the reservation
    $query = "DELETE FROM reservation WHERE id_reservation = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $reservation_id);
    
    // Execute the query
    if ($stmt->execute()) {
        // Reservation successfully canceled
        echo "<script>alert('Reservation canceled successfully.');</script>";
        echo "<script>window.location.href='proposer.php';</script>";  
   
    } else {
        // Error occurred while canceling reservation
        echo "<script>alert('Failed to cancel reservation.');</script>";
        echo "<script>window.location.href='proposer.php';</script>"; // Redirect to previous page
    }
} else {
    // If reservation ID is not provided in the query parameter, handle accordingly
    echo "<script>alert('Reservation ID not provided.');</script>";
    echo "<script>window.location.href='proposer.php';</script>"; // Redirect to previous page
}
?>
