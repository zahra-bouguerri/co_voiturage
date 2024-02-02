<?php include "../config/connect.php"?>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="index.html">RYZ<span>Trips</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto mr-auto">
                <li class="nav-item active"><a href="index.php" class="nav-link">Acceuil</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link">A propos</a></li>
                <li class="nav-item"><a href="index.php#nos_trajet" class="nav-link">Trajet</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>

                <?php
                // Check if the 'loggedIn' key and 'role' key are set in the $_SESSION array
                if (isset($_SESSION['loggedIn']) && isset($_SESSION['role'])) {
                    // Check if the user is a conductor
                    if ($_SESSION['loggedIn'] && $_SESSION['role'] == 'conducteur') {
                        echo '<li class="nav-item"><a href="conducteur.php?id=' . $_SESSION['userId'] . '" class="nav-link">Gérer </a></li>';
                    }
                }
                ?>
                        <?php
                // Check if the 'loggedIn' key and 'role' key are set in the $_SESSION array
                if (isset($_SESSION['loggedIn']) && isset($_SESSION['role'])) {
                    // Check if the user is a conductor
                    if ($_SESSION['loggedIn'] && $_SESSION['role'] == 'client') {
                        echo '<li class="nav-item"><a href="proposer.php?id=' . $_SESSION['userId'] . '" class="nav-link">Mes Reservations </a></li>';
                    }
                }
                ?>
                <li class="nav-item"><a href="register.php" class="nav-link btn btn-primary small-btn">Inscription</a></li>
                &nbsp;&nbsp;&nbsp;
                <li class="nav-item"><a href="login.php" class="nav-link btn btn-primary small-btn">Connexion</a></li>
            </ul>
            </form>
        </div>
    </div>
</nav>