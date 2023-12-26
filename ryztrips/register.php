<!DOCTYPE html>
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
        <img src="./images/login.jpeg" alt="">
        <div class="text">
          <span class="text-1">Chaque nouveau trajet est une <br> nouvelle expérience</span>
          <span class="text-2">"Connectez-vous."</span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Connexion Cliente</div>
            <form action="#">
                <div class="input-boxes">
                 <div class="flex">
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nom" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Prenom" required>
                    </div>
                </div>
                    <div class="input-box">
                        <i class="fas fa-phone"></i>
                        <input type="tel" placeholder="Numero telephone" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="Adresse e-mail" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="button input-box">
                        <input type="submit" value="Envoyer">
                    </div>
                    <div class="text sign-up-text"> <label for="flip">Connectez-vous en tantque condicteur</label></div>
                    <div class="text sign-up-text">Vous avez déjà un compte ? <label for="flip" onclick="redirigerVersConnexion()">Connectez-vous </label></div>
            </div>
      </form>
      </div>
        <div class="signup-form">
            <div class="title">Connexion Condecteur</div>
            <form action="#">
                <div class="flex">
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nom" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Prenom" required>
                    </div>
                </div>
                <div class="flex">
                    <div class="input-box">
                        <i class="fas fa-car"></i>
                        <input type="text" placeholder="Matricule" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-car"></i>
                        <input type="text" placeholder="Nom Voiture" required>
                    </div>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-phone"></i>
                        <input type="tel" placeholder="Numero telephone" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="Adresse e-mail" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Mot de passe" required>
                    </div>
              
                    </form>
                    </form>
                    <div class="button input-box">
                        <input type="submit" value="Envoyer">
                    </div>
                    <div class="text sign-up-text"> <label for="flip">Connectez-vous en tantque client</label></div>
                    <div class="text sign-up-text">Vous avez déjà un compte ? <label for="flip" onclick="redirigerVersConnexion()">Connectez-vous </label></div>

                    <script>
                        function redirigerVersConnexion() {
                            window.location.href = 'login.html';
                        }
                    </script>
                </div>
      </form>
    </div>
    </div>
    </div>
  </div>
</body>
</html>
