<?php
include('../config/connect.php');
?>
<?php include "includes/header.php"; ?>
<style>
  /* Styles personnalisés pour le conteneur */
  .r {
    margin-left: auto; /* Marge à gauche automatique pour décaler vers la droite */
    max-width: 1000px; /* Largeur maximale du conteneur */
    padding: 30px; /* Espacement intérieur */
    
    border-radius: 10px; /* Coins arrondis */
    
  }
</style>

<div class="container ml-auto">
    <div class="r">
  <h3 class="mt-4 mb-4">Modifier Nombre de place au maximum pour les trajets </h3>
</br>

  <?php
  // Inclure votre connexion à la base de données ici
  include('../config/connect.php');

  // Récupérer la valeur actuelle de nombre_max
  $queryNombreMax = "SELECT nombre_max FROM paramètres WHERE id_parametre = 1";
  $resultNombreMax = $conn->query($queryNombreMax);

  if ($resultNombreMax) {
    $rowNombreMax = $resultNombreMax->fetch_assoc();
    $nombreMaxActuel = $rowNombreMax['nombre_max'];

    
  } else {
    echo "<p>Erreur lors de la récupération de la valeur actuelle de Nombre Max.</p>";
  }

  // Fermer le résultat de la requête pour obtenir nombre_max
  $resultNombreMax->close();
  ?>

  <form action="modifier_nombre_max.php" method="post">
    <div class="form-group">
     
    <input type="number" class="form-control text-muted" id="nouveauNombreMax" name="nouveauNombreMax" value="<?php echo $nombreMaxActuel; ?>" required>

    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
  </form>
    </div>
</div>
<?php include "./includes/footer.php" ?>
