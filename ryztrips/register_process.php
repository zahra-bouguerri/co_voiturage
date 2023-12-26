<?php
include('../config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifiez quel formulaire a été soumis
    if (isset($_POST['client_submit'])) {
        // Formulaire client
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Effectuez l'insertion dans la table client
        $query = "INSERT INTO client (nom, prenom, numero_tel, adresse_client, mdp_client) VALUES ('$nom', '$prenom', '$telephone', '$email', '$password')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Erreur d'insertion dans la table client : " . mysqli_error($conn));
        }

        // Redirigez l'utilisateur vers la page de connexion
        header('Location: login.php');
    } elseif (isset($_POST['conducteur_submit'])) {
        // Formulaire conducteur
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $matricule = $_POST['matricule'];
        $nom_voiture = $_POST['nom_voiture'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Effectuez l'insertion dans la table conducteur
        $query = "INSERT INTO conducteur (nom, prenom, matricule_voiture, voiture, numero_tel, adresse_conducteur, mdp_conducteur) VALUES ('$nom', '$prenom', '$matricule', '$nom_voiture', '$telephone', '$email', '$password')";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die("Erreur d'insertion dans la table conducteur : " . mysqli_error($conn));
        }

        // Redirigez l'utilisateur vers la page de connexion
        header('Location: login.php');
    }
}

mysqli_close($conn);
?>
