<?php
include "../config/connect.php";
if (isset($_GET['email'])) {
    $email = $_GET['email'];

    if (isset($_POST['verify'])) {
        $enteredCode = $_POST['verification_code'];

        // Vérifier si le code de vérification saisi correspond à celui stocké dans la base de données
        $sql = "SELECT * FROM client WHERE adresse_client=? AND verification_token=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $email, $enteredCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            // Mettre à jour le compte de l'utilisateur comme vérifié
            $sql = "UPDATE client SET is_verified=1, verification_token=NULL WHERE adresse_client=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();

            echo "<script>alert('La vérification de l'adresse e-mail a réussi. Vous pouvez maintenant vous connecter.');</script>";
            echo "<script>window.location.href='login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Code de vérification incorrect.');</script>";
        }
    }
} else {
    echo "<script>alert('Demande non valide. Veuillez réessayer.');</script>";
    echo "<script>window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'adresse e-mail</title>
     <!-- Favicon -->
     <link href="./assets/img/favicon.png" rel="icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
        }

        input[type="text"] {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Vérification de l'adresse e-mail</h1>
        <p>Entrez le code que vous avez reçu dans votre boîte e-mail</p>
        <form method="post">
            <input type="text" name="verification_code" required>
            <button type="submit" name="verify">Vérifier</button>
        </form>
    </div>
</body>
</html>