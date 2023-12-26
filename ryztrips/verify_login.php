<?php
// Inclure le fichier de connexion à la base de données
include('../config/connect.php');
var_dump($_POST);

// Récupérer les valeurs du formulaire
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

// Échapper les valeurs pour éviter les injections SQL (utilisez mysqli_real_escape_string ou mieux, les déclarations préparées)
$email = mysqli_real_escape_string($conn, $email);
$password = mysqli_real_escape_string($conn, $password);

// Vérifier le rôle et effectuer la requête SQL appropriée
if ($role === 'conducteur') {
    $query = "SELECT * FROM conducteur WHERE adresse_conducteur = '$email' AND mdp_conducteur = '$password'";
} elseif ($role === 'client') {
    $query = "SELECT * FROM client WHERE adresse_client	 = '$email' AND mdp_client	 = '$password'";
} else {
    // Gérer d'autres rôles si nécessaire
    die("Rôle non reconnu");
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Erreur d'exécution de la requête : " . mysqli_error($conn));
}

// Vérifier si les identifiants sont corrects
if (mysqli_num_rows($result) > 0) {
    // Authentification réussie, rediriger vers la page appropriée
    if ($role === 'conducteur') {
        header('Location: conducteur.php');
    } elseif ($role === 'client') {
        header('Location: index.php');
    }
} else {
    // Identifiants incorrects, afficher un message d'erreur
    header('Location: login.php?error=1'); // Ajoutez un paramètre d'erreur dans l'URL pour gérer l'affichage du message
}

// Fermer la connexion à la base de données
mysqli_close($conn);
?>
