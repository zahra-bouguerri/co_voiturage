<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include('../config/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['client_submit'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          // Validate phone number
          if (!preg_match('/^(07|05|06)\d{8}$/', $telephone)) {
            echo "<script>alert('Veuillez entrer un numéro de téléphone valide.');</script>";
            header('Location: register.php');
            exit();
        }
      // Check if email already exists and is verified
  $sql_check_email = "SELECT * FROM client WHERE adresse_client=? AND is_verified=1";
  $stmt_check_email = $conn->prepare($sql_check_email);
  $stmt_check_email->bind_param("s", $email);
  $stmt_check_email->execute();
  $result_check_email = $stmt_check_email->get_result();

  if ($result_check_email->num_rows > 0) {
    echo "<script>alert('L\'adresse e-mail existe déjà et est vérifiée.');</script>";
      echo "<script>window.location.href = 'register.php';</script>";
      exit();
  }
        // Check if telephone already exists and is verified
        $sql_check_tel = "SELECT * FROM client WHERE numero_tel=? ";
        $stmt_check_tel = $conn->prepare($sql_check_tel);
        $stmt_check_tel->bind_param("s", $telephone);
        $stmt_check_tel->execute();
        $result_check_tel = $stmt_check_tel->get_result();

            if ($result_check_tel->num_rows > 0) {
                echo "<script>alert('Le numéro de téléphone existe déjà.');</script>";
                echo "<script>window.location.href = 'register.php';</script>";
                exit();
        }
        $sql_check = "SELECT * FROM client WHERE adresse_client=? AND is_verified=0";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 1) {
            $sql_delete = "DELETE FROM client WHERE adresse_client=? AND is_verified=0";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("s", $email);
            $stmt_delete->execute();
        }

        $verificationCode = mt_rand(100000, 999999);

        $query = "INSERT INTO client (nom, prenom, numero_tel, adresse_client, mdp_client, verification_token, is_verified) VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('sssssi', $nom, $prenom, $telephone, $email, $hashed_password, $verificationCode);
        $success = $stmt->execute();

        if ($success) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'covoiturageryz@gmail.com';
            $mail->Password = 'npvugorhtbixsdpk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('covoiturageryz@gmail.com', 'ryzTrips');
            $mail->addAddress($email);
            $mail->Subject = 'Verify Your Email';
            $mail->Body = "Your verification code is: $verificationCode";

            if ($mail->send()) {
                header('Location: verifyClient.php?email=' . $email);
                exit();
            } else {
                echo "<script>alert('Email sending failed: " . $mail->ErrorInfo . "');</script>";
                header('Location: index.php');
                exit();
            }
        } else {
            echo "<script>alert('Please try again later.');</script>";
            header('Location: index.php');
            exit();
        }
    } elseif (isset($_POST['conducteur_submit'])) {
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $matricule = $_POST['matricule'];
        $nom_voiture = $_POST['nom_voiture'];
        $telephone = $_POST['telephone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          // Validate phone number
          if (!preg_match('/^(07|05|06)\d{8}$/', $telephone)) {
            echo "<script>alert('Veuillez entrer un numéro de téléphone valide.');</script>";
            echo "<script>window.location.href = 'register.php';</script>";
            exit();
        }
  // Check if email already exists and is verified
  $sql_check_email = "SELECT * FROM conducteur WHERE adresse_conducteur=? AND is_verified=1";
  $stmt_check_email = $conn->prepare($sql_check_email);
  $stmt_check_email->bind_param("s", $email);
  $stmt_check_email->execute();
  $result_check_email = $stmt_check_email->get_result();

  if ($result_check_email->num_rows > 0) {
    echo "<script>alert('L\'adresse e-mail existe déjà et est vérifiée.');</script>";
      echo "<script>window.location.href = 'register.php';</script>";
      exit();
  }
        // Check if telephone already exists and is verified
        $sql_check_tel = "SELECT * FROM conducteur WHERE numero_tel=? ";
        $stmt_check_tel = $conn->prepare($sql_check_tel);
        $stmt_check_tel->bind_param("s", $telephone);
        $stmt_check_tel->execute();
        $result_check_tel = $stmt_check_tel->get_result();

        if ($result_check_tel->num_rows > 0) {
            echo "<script>alert('Le numéro de téléphone existe déjà ');</script>";
            echo "<script>window.location.href = 'register.php';</script>";
            exit();
        }

          // Check if matricule already exists
          $sql_check_matricule = "SELECT * FROM conducteur WHERE matricule_voiture=?";
          $stmt_check_matricule = $conn->prepare($sql_check_matricule);
          $stmt_check_matricule->bind_param("s", $matricule);
          $stmt_check_matricule->execute();
          $result_check_matricule = $stmt_check_matricule->get_result();
  
          if ($result_check_matricule->num_rows > 0) {
              echo "<script>alert('Le matricule de voiture existe déjà.');</script>";
              echo "<script>window.location.href = 'register.php';</script>";
              exit();
          }
        $sql_check = "SELECT * FROM conducteur WHERE adresse_conducteur=? AND is_verified=0";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 1) {
            $sql_delete = "DELETE FROM conducteur WHERE adresse_conducteur=? AND is_verified=0";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("s", $email);
            $stmt_delete->execute();
        }

        $verificationCode = mt_rand(100000, 999999);

        $query = "INSERT INTO conducteur (nom, prenom, matricule_voiture, voiture, numero_tel, adresse_conducteur, mdp_conducteur, verification_token, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
$stmt = $conn->prepare($query);
$stmt->bind_param('ssssisss', $nom, $prenom, $matricule, $nom_voiture, $telephone, $email, $hashed_password, $verificationCode);
        $success = $stmt->execute();

        if ($success) {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'covoiturageryz@gmail.com';
            $mail->Password = 'npvugorhtbixsdpk';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('covoiturageryz@gmail.com', 'ryzTrips');
            $mail->addAddress($email);
            $mail->Subject = 'Verify Your Email';
            $mail->Body = "Your verification code is: $verificationCode";

            if ($mail->send()) {
                header('Location: verifyCon.php?email=' . $email);
                exit();
            } else {
                echo "<script>alert('Email sending failed: " . $mail->ErrorInfo . "');</script>";
                header('Location: index.php');
                exit();
            }
        } else {
            echo "<script>alert('Please try again later.');</script>";
            header('Location: index.php');
            exit();
        }
    }
}
?>
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
            <div class="title"> Inscription Client</div>
            <form  method="post">
                <div class="input-boxes">
                 <div class="flex">
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text" name="nom" placeholder="Nom" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-user"></i>
                        <input type="text"  name="prenom" placeholder="Prenom" required>
                    </div>
                </div>
                    <div class="input-box">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="telephone" placeholder="Numero telephone" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="email" placeholder="Adresse e-mail" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>
                    <div class="button input-box">
                        <input type="submit" name="client_submit" value="Envoyer">
                    </div>
                    <div class="text sign-up-text"> <label for="flip"> Inscrez-vous en tantque condicteur</label></div>
                    <div class="text sign-up-text">Vous avez déjà un compte ? <label for="flip" onclick="redirigerVersConnexion()">Connectez-vous </label></div>
            </div>
      </form>
      </div>
        <div class="signup-form">
            <div class="title"> Inscription  Conducteur</div>
            <form  method="post">
                    <div class="flex">
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="nom" placeholder="Nom" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-user"></i>
                            <input type="text" name="prenom" placeholder="Prenom" required>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="input-box">
                            <i class="fas fa-car"></i>
                            <input type="text" name="matricule" placeholder="Matricule" required>
                        </div>
                        <div class="input-box">
                            <i class="fas fa-car"></i>
                            <input type="text" name="nom_voiture" placeholder="Nom Voiture" required>
                        </div>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-phone"></i>
                        <input type="tel" name="telephone" placeholder="Numero telephone" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-envelope"></i>
                        <input type="text" name="email" placeholder="Adresse e-mail" required>
                    </div>
                    <div class="input-box">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Mot de passe" required>
                    </div>
            
                    <div class="button input-box">
                        <input type="submit" name="conducteur_submit" value="Envoyer">
                    </div>
                    <div class="text sign-up-text"> <label for="flip"> Inscrez-vous en tantque client</label></div>
                    <div class="text sign-up-text">Vous avez déjà un compte ? <label for="flip" onclick="redirigerVersConnexion()">Connectez-vous </label></div>

                </div>
      </form>
    </div>
    </div>
    </div>
  </div>
  <script>
    function redirigerVersConnexion() {
        window.location.href = 'login.php';
    }
</script>
</body>
</html>
