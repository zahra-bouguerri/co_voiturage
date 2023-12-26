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
            <?php
            if (isset($_GET['error']) && $_GET['error'] == 1) {
                echo '<p style="color: red;">Adresse e-mail ou mot de passe incorrect</p>';
            }
          ?>
          <form action="verify_login.php" method="post">
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
              <div class="text"><a href="#">Forgot password?</a></div>
              <div class="button input-box">
                <input type="submit" value="Submit">
              </div>
              <div class="text sign-up-text">Vous n'avez pas de compte ? <a href="register.php"> Connectez-vous</a></div>
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
