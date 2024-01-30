<?php
include('../config/connect.php');

if (isset($_POST['submit'])) {
    // Logique de connexion
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Choix de la table appropriée en fonction du rôle de l'utilisateur
    $table = ($role == 'client') ? 'client' : 'conducteur';
    $emailField = ($role == 'client') ? 'adresse_client' : 'adresse_conducteur';
    $passwordField = ($role == 'client') ? 'mdp_client' : 'mdp_conducteur';
    $idField = ($role == 'client') ? 'id_client' : 'id_conducteur';

    $sql = "SELECT * FROM $table WHERE $emailField=? AND is_verified=1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row[$passwordField])) {
        // Connexion réussie
        $_SESSION['loggedIn'] = true;
        $_SESSION['role'] = $role;
        $_SESSION['userId'] = $row[$idField];

            // Définir un cookie pour une connexion persistante si "Se souvenir de moi" est coché
            if (isset($_POST['remember_me']) && $_POST['remember_me'] == 1) {
                $cookie_name = 'remember_me_cookie';
                $cookie_value = $_SESSION['userId'];
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // Le cookie expire en 30 jours
            }
            // Redirection en fonction du rôle
            if ($role == 'conducteur') {
              echo "<script>alert('Connexion réussie !'); 
              window.location.href='conducteur.php?userId=" . $_SESSION['userId'] . "';</script>";
          } else {
              echo "<script>alert('Connexion réussie !'); 
              window.location.href='index.php?userId=" . $_SESSION['userId'] . "';</script>";
          }
          exit();

        } 
        else {
          $email_error = "L'adresse e-mail que vous avez saisie n'existe pas.";
          header("Location: login.php?error=1");
          exit();
        }
    } else {
        $email_error = "L'adresse e-mail que vous avez saisie n'existe pas.";
        header("Location: login.php?error=1");
        exit();

          }
}
?>


<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!--<title> Login and Registration Form in HTML & CSS | CodingLab </title>-->
    <link rel="stylesheet" href="./css/login.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <div class="container">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="images/frontImg.jpeg" alt="">
    
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
           
          <form  method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" name="email" placeholder="Adresse e-mail" required>
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" placeholder="Mot de passe" required>
              </div>
              <div class="input-box">
                
              <label>
                  <input type="radio" name="role" value="client" checked> 
                  <span>Client</span>
              </label>
              <label>
                  <input type="radio" name="role" value="conducteur"> 
                  <span>Conducteur</span>
              </label>
              </div>
             
              <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color: red;">Adresse e-mail ou mot de passe incorrect</p>';
            }
          ?>
              <div class="button input-box">
                <input type="submit" name="submit" value="Submit">
              </div>
              <div class="text sign-up-text">Vous n'avez pas de compte ? <a href="register.php"> Inscrez-vous </a></div>
            </div>
          </form>
      </div>
      
    </div>
    </div>
  </div>
</body>
<script>
    function redirigerVersInscription() {
        window.location.href = 'register.php';
    }
</script>
</html>
