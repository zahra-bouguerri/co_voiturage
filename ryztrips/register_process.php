<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require './vendor/autoload.php';
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
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

          // Check if the email already exists but is not verified
        $sql_check = "SELECT * FROM client WHERE email=? AND is_verified=0";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows == 1) {
            // Email exists but not verified, delete the unverified record
            $sql_delete = "DELETE FROM client WHERE adresse_client=? AND is_verified=0";
            $stmt_delete = $conn->prepare($sql_delete);
            $stmt_delete->bind_param("s", $email);
            $stmt_delete->execute();
         }

                // Generate a verification code
                $verificationCode = mt_rand(100000, 999999); // Generate a 6-digit code

                // Effectuez l'insertion dans la table client
                $query = "INSERT INTO client (nom, prenom, numero_tel, adresse_client, mdp_client, verification_token, is_verified)VALUES (?, ?, ?, ?, ?, ?, 0)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param('sssssi', $nom, $prenom, $telephone,$email, $hashed_password, $verificationCode);
                $success = $stmt->execute();

                if ($success) {
                    // Send the verification email using PHPMailer
                    // Load PHPMailer
                $mail = new PHPMailer(true);
                    // Enable SMTP
                    $mail->isSMTP();
                    // Set the SMTP server to send through
                    $mail->Host       = 'smtp.gmail.com';
                    // Enable SMTP authentication
                    $mail->SMTPAuth   = true;
                    // SMTP username
                    $mail->Username   = 'covoiturageryz@gmail.com';
                    // SMTP password
                    $mail->Password   = 'npvugorhtbixsdpk';
            
                    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->SMTPSecure = 'ssl';
            
                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                    $mail->Port       = 465;
                    // Set the sender and recipient
                    $mail->setFrom('covoiturageryz@gmail.com', 'ryzTrips'); // Replace with your sender email and name
                    $mail->addAddress($email); // Recipient's email
            
                    // Set email subject and body
                    $mail->Subject = 'Verify Your Email';
                    $mail->Body = "Your verification code is: $verificationCode";
            
                    // Send the email
                    if ($mail->send()) {
                        // Email sent successfully
                        // Redirect to the verification page
                        echo "<script>window.location.href='verify.php?email=$email';</script>";
                        exit();
                    } else {
                        // Email sending failed
                        echo "<script>alert('Email sending failed: " . $mail->ErrorInfo . "');</script>";
                        echo "<script>window.location.href='index.php';</script>";
                        exit();
                    }
                } else {
                    echo "<script>alert('Please try again later.');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                    exit();
                }
            
            
        } elseif (isset($_POST['conducteur_submit'])) {
           // Formulaire conducteur
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $matricule = $_POST['matricule'];
    $nom_voiture = $_POST['nom_voiture'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if the email already exists but is not verified
    $sql_check = "SELECT * FROM conducteur WHERE adresse_conducteur=? AND is_verified=0";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows == 1) {
        // Email exists but not verified, delete the unverified record
        $sql_delete = "DELETE FROM conducteur WHERE adresse_conducteur=? AND is_verified=0";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("s", $email);
        $stmt_delete->execute();
    }

    // Generate a verification code
    $verificationCode = mt_rand(100000, 999999); // Generate a 6-digit code

    // Effectuez l'insertion dans la table conducteur
    $query = "INSERT INTO conducteur (nom, prenom, matricule_voiture, voiture, numero_tel, adresse_conducteur, mdp_conducteur, verification_token, is_verified) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssisss', $nom, $prenom, $matricule, $nom_voiture, $telephone, $email, $hashed_password, $verificationCode);
    $success = $stmt->execute();
            if ($success) {
                // Send the verification email using PHPMailer
                // Load PHPMailer
            $mail = new PHPMailer(true);
        
        
                // Enable SMTP
                $mail->isSMTP();
        
                // Set the SMTP server to send through
                $mail->Host       = 'smtp.gmail.com';
        
                // Enable SMTP authentication
                $mail->SMTPAuth   = true;
        
                // SMTP username
                $mail->Username   = 'covoiturageryz@gmail.com';
        
                // SMTP password
                $mail->Password   = 'npvugorhtbixsdpk';
        
                // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->SMTPSecure = 'ssl';
        
                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                $mail->Port       = 465;
                // Set the sender and recipient
                $mail->setFrom('covoiturageryz@gmail.com', 'ryzTrips'); // Replace with your sender email and name
                $mail->addAddress($email); // Recipient's email
        
                // Set email subject and body
                $mail->Subject = 'Verify Your Email';
                $mail->Body = "Your verification code is: $verificationCode";
        
                // Send the email
                if ($mail->send()) {
                    // Email sent successfully
                    // Redirect to the verification page
                    echo "<script>window.location.href='verify.php?email=$email';</script>";
                    exit();
                } else {
                    // Email sending failed
                    echo "<script>alert('Email sending failed: " . $mail->ErrorInfo . "');</script>";
                    echo "<script>window.location.href='index.php';</script>";
                    exit();
                }
            } else {
                echo "<script>alert('Please try again later.');</script>";
                echo "<script>window.location.href='index.php';</script>";
                exit();
            }
        }
    }
    ?>

