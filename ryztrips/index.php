<?php include "./includes/header.php"?>

    <div class="hero-wrap" style="background-image: url('images/bg_1.png');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
		  <div class="row no-gutters slider-text justify-content-start align-items-center">
			<div class="col-lg-6 col-md-6 ftco-animate d-flex align-items-end">
				<div class="text">
				  <h1 class="mb-4">Voyagez et  <span> Réservez avec Simplicité </span></h1>
				  <p style="font-size: 18px;"> Avec notre service de réservation en ligne, </br> découvrez le confort d'un voyage sans souci,</br> où chaque détail est pris en charge pour</br> vous. </p>
				  <a href="https://vimeo.com/45830194" class="icon-wrap popup-vimeo d-flex align-items-center mt-4">
					  <div class="icon d-flex align-items-center justify-content-center">
						<span class="ion-ios-play"></span>
					  </div>
					  <div class="heading-title ml-5">
						  <span>étape pour réserver trajet</span>
					  </div>
				  </a>
			  </div>
			</div>
			<div class="col-lg-2 col"></div>
			<div class="col-lg-4 col-md-6 mt-0 mt-md-5 d-flex">
				
			</div>
		  </div>
		</div>
	  </div>
          <div class="col-lg-2 col"></div>
          <div class="col-lg-4 col-md-6 mt-0 mt-md-5 d-flex">
    
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pb ftco-no-pt">
    	<div class="container">
	    	<div class="row">
					<div class="col-md-12">
						<div class="row justify-content-center heading-section text-center ">
							<h2 class="mb-2" style="margin-top: 30px;">Rechercher un trajet</h2>
						</div>
						<div class="search-wrap-1 ftco-animate mb-5">
							<form action="#" class="search-property-1">
		        		<div class="row">
		        			<div class="col-lg align-items-end">
		        				<div class="form-group">
		        					<label for="#">endroit de départ</label>
		        					<div class="form-field">
		          					<div class="select-wrap">
							  <input type="text" class="form-control" placeholder="City, Airport, Station, etc">
		                    </div>
				              </div>
			              </div>
		        			</div>
		        			<div class="col-lg align-items-end">
		        				<div class="form-group">
		        					<label for="#">endroit d'arrivée</label>
		        					<div class="form-field">
		          					<div class="select-wrap">
										<input type="text" class="form-control" placeholder="City, Airport, Station, etc">
		                    </div>
				              </div>
			              </div>
		        			</div>
		        			<div class="col-lg align-items-end">
		        				<div class="form-group">
		        					<label for="#">date de départ </label>
		        					<div class="form-field">
		          					<div class="select-wrap">
										<input type="date" class="form-control" id="book_pick_date">
		                    </div>
				              </div>
			              </div>
		        			</div>
		        			<div class="col-lg align-items-end">
		        				<div class="form-group">
		        					<label for="#">heure de départ</label>
		        					<div class="form-field">
		          					<div class="select-wrap">
										<input type="time" class="form-control" id="book_pick_time">
		                      
		                    </div>
				              </div>
			              </div>
		        			</div>
		        			<div class="col-lg align-self-end">
		        				<div class="form-group">
		        					<div class="form-field">
										<input type="button" value="Recherche" class="form-control btn btn-primary" onclick="redirectToSearchPage()">
								
				              </div>
			              </div>
		        			</div>
		        		</div>
		        	</form>
		        </div>
					</div>
	    	</div>
	    </div>
    </section>

    <section class="ftco-section services-section ftco-no-pt ftco-no-pb">
		<div class="container">
			<div class="row justify-content-center">
			<div class="col-md-12 heading-section text-center ftco-animate mb-5">
				<span class="subheading">Nos Services</span>
			  <h2 class="mb-2">Nos Services</h2>
			</div>
		  </div>
		  <div class="row d-flex">
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services">
				<div class="media-body py-md-4">
					<div class="d-flex mb-3 align-items-center">
						<div class="icon"><span class="flaticon-customer-support"></span></div>
					  <h3 class="heading mb-0 pl-3">24/7 Assistance Automobile</h3>
				  </div>
				  <p>Assistance disponible à toute heure pour répondre aux besoins des conducteurs.</p>
				</div>
			  </div>      
			</div>
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services">
				<div class="media-body py-md-4">
					<div class="d-flex mb-3 align-items-center">
						<div class="icon"><span class="flaticon-route"></span></div>
					  <h3 class="heading mb-0 pl-3">Nombreux emplacements</h3>
				  </div>
				  <p>Une multitude d'emplacements à travers lesquels notre service s'étend pour une accessibilité optimale.</p>
				</div>
			  </div>      
			</div>
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services">
				<div class="media-body py-md-4">
					<div class="d-flex mb-3 align-items-center">
						<div class="icon"><span class="flaticon-online-booking"></span></div>
					  <h3 class="heading mb-0 pl-3">Réservation</h3>
				  </div>
				  <p>Un processus simple et efficace pour réserver votre trajet en quelques étapes.</p>
				</div>
			  </div>      
			</div>
			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
			  <div class="media block-6 services">
				<div class="media-body py-md-4">
					<div class="d-flex mb-3 align-items-center">
						<div class="icon"><span class="flaticon-rent"></span></div>
					  <h3 class="heading mb-0 pl-3">Location de voitures</h3>
				  </div>
				  <p>Offre de véhicules disponibles à la location pour répondre à vos besoins de déplacement.</p>
				</div>
			  </div>      
			</div>
		  </div>
		</div>
	  </section>
  

    <section id="nos_trajet" class="ftco-section">
    	<div class="container-fluid px-4">
    		<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">Ce que nous offrons</span>
            <h2 class="mb-2">choisissez votre trajet</h2>
          </div>
        </div>
		<?php
// Set the number of records per page
$records_per_page = 8;

// Get the current page from the URL parameter
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $records_per_page;

// Fetch records for the current page
$query = "SELECT t.*, c.* FROM trajet t
          JOIN conducteur c ON t.id_conducteur = c.id_conducteur
          LIMIT $records_per_page OFFSET $offset";
$result = mysqli_query($conn, $query);
?>
<div class="row">
    <?php 
    if (mysqli_num_rows($result) > 0) {
        // Loop through each row in the result set
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <div class="col-md-3">
            <div class="car-wrap ">
          
                <div class="text p-4 ">
                    <h4 class="mb-0"><a href="#"><?php echo $row['lieu_depart']?>&rarr;<?php echo $row['destination']?></a></h4>
                    </br>
					<h6><span>Date depart :</span> <?php echo $row['date_trajet']?></h6>
					<h6><span>Heure depart :</span> <?php echo $row['heure_depart']?></h6>
					<h6><span>Prix :</span> <?php echo $row['prix']?></h6>
					<h6><span>conducteur :</span> <?php echo $row['nom']?></h6>
                    <h6><span>voiture :</span> <?php echo $row['voiture']?></h6>
                    <h6><span>place disponible : <?php echo $row['nb_places_dispo']?></h6>
					<br>
                    <p class="text-center"><a href="reserver.php" class="btn btn-black btn-outline-black mr-1">Réserver maintenant</a></p>
                </div>
				<br>
            </div>
        </div>
		
    <?php
        } // Close the while loop
    } else {
        // No trips found
        echo '<p>No trips available.</p>';
    }
  
    ?>
</div>
<?php
// Get the total number of records in the "trajet" table
$total_records_query = "SELECT COUNT(*) as total FROM trajet";
$total_records_result = $conn->query($total_records_query);

if ($total_records_result) {
    $total_records_row = $total_records_result->fetch_assoc();
    $total_records = $total_records_row['total'];

    // Calculate the total number of pages
    $total_pages = ceil($total_records / $records_per_page);
} else {
    $total_pages = 0;
}

// Display pagination links
?>
<div class="row mt-5">
    <div class="col text-center">
        <div class="block-27">
            <ul>
                <?php
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($i == $current_page) {
                        echo "<li class='active'><span>$i</span></li>";
                    } else {
                        echo "<li><a href='?page=$i'>$i</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>
    	
    </section>

    <section class="ftco-section services-section img" style="background-image: url(images/bg_2.jpeg);">
    	<div class="overlay"></div>
    	<div class="container">
    		<div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
          	<span class="subheading">Work flow</span>
            <h2 class="mb-3">How it works</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services services-2">
              <div class="media-body py-md-4 text-center">
              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                <h3>Pick Destination</h3>
                <p>A small river named Duden flows by their place and supplies it with you</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services services-2">
              <div class="media-body py-md-4 text-center">
              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-select"></span></div>
                <h3>Select Term</h3>
                <p>A small river named Duden flows by their place and supplies it with you</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services services-2">
              <div class="media-body py-md-4 text-center">
              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                <h3>Choose A Car</h3>
                <p>A small river named Duden flows by their place and supplies it with you</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services services-2">
              <div class="media-body py-md-4 text-center">
              	<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-review"></span></div>
                <h3>Enjoy The Ride</h3>
                <p>A small river named Duden flows by their place and supplies it with you</p>
              </div>
            </div>      
          </div>
    		</div>
    	</div>
    </section>

    <section class="ftco-section testimony-section">
      <div class="container">
        <div class="row justify-content-center mb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
			<span class="subheading">Témoignage</span>
			<h2 class="mb-3">Clients Satisfaits</h2>
          </div>
        </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
            <div class="carousel-testimony owl-carousel ftco-owl">
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Marketing Manager</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_2.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Interface Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_3.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">UI Designer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">Web Developer</span>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="testimony-wrap text-center py-4 pb-5">
                  <div class="user-img mb-4" style="background-image: url(images/person_1.jpg)">
                  </div>
                  <div class="text pt-4">
                    <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <p class="name">Roger Scott</p>
                    <span class="position">System Analyst</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpeg);">
					</div>
					<div class="col-md-6 wrap-about py-md-5 ftco-animate">
	          <div class="heading-section mb-5 pl-md-5">
	          	<span class="subheading">A Propos</span>
	            <h2 class="mb-4">Trouvez la voiture idéale</h2>

	            <p>Chez RyzTrips, nous sommes fiers de révolutionner votre expérience du voyage. Notre engagement est de fournir une commodité inégalée et des services personnalisés qui répondent à vos préférences uniques. Axés sur l'innovation et la satisfaction client, nous nous efforçons de rendre chaque voyage mémorable. Des réservations sans faille à l'autonomisation des conducteurs et à l'offre de trajets personnalisés, nous sommes déterminés à remodeler le paysage des transports. Choisissez RyzTrips pour une expérience de voyage transformative qui vous met aux commandes de votre trajet.</p>
	            <p><a href="#" class="btn btn-primary">Search Trip</a></p>
	          </div>
					</div>
				</div>
			</div>
		</section>

    <section class="ftco-section">
    </section>	
	<?php include "./includes/footer.php";?>

  