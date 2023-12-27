<?php include "./includes/header.php"?>  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<style>
        .form-container {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-container h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .label {
            color: #333;
            font-size: 16px;
            margin-bottom: 5px;
        }
</style>
    <section class="ftco-section services-section img" style="background-image: url(images/conducteur.avif);">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
</br></br>
          
</br>
            <h2 class="mb-3">Proposer vos trajets</h2>
            <span class="subheading">Aidez-nous à ameliorer notre application en proposant vos trajets souhaités</span>
    </br>
    </br>

           
          </div>
        </div>	
    	</div>
    </section>
  
</br>
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="form-container">
                <!-- Contenu du premier formulaire -->
                <section class="ftco-section ftco-no-pb ftco-no-pt">
                    <form action="#" class="request-form ftco-animate">
                        <h2>Proposer un trajet</h2>
                        <div class="form-group">
                            <label for="" class="label">Lieu de départ</label>
                            <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
                        </div>
                        <div class="form-group">
                            <label for="" class="label">Lieu d'arivée</label>
                            <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
                        </div>	
                        <!-- Autres champs du formulaire... -->
                        <div class="form-group">
                        <input type="button" value="Envoyer" class="form-control btn btn-primary" onclick="redirectToSearchPage()">
                        </div>
                    </form>
                </section>
            </div>
        </div>
       
            </div>
        </div>
    </div>
</div>
    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<?php include "./includes/footer.php";?>

  