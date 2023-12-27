<?php include "./includes/header.php";?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bgcontact.jpeg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Acceuil <i class="ion-ios-arrow-forward"></i></a></span> <span>Contactez-nous <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Contactez-nous</h1>
          </div>
        </div>
      </div>
    </section>

		<section class="ftco-section contact-section">
      <div class="container">
        <div class="row d-flex mb-4 contact-info justify-content-center">
        	<div class="col-md-8">
        		<div class="row mb-5">
		          <div class="col-md-4 text-center border-height py-4">
		          	<div class="icon">
		          		<span class="icon-mobile-phone"></span>
		          	</div>
		            <p><span>Numero de telephone:</span> <a href="tel://1234567920">+213 1235 2355 98</a></p>
		          </div>
		          <div class="col-md-4 text-center py-4">
		          	<div class="icon">
		          		<span class="icon-envelope-o"></span>
		          	</div>
		            <p><span>Email:</span> <a href="mailto:info@yoursite.com">ryzdevlopper@yoursite.com</a></p>
		          </div>
		        </div>
          </div>
        </div>
        <div class="row block-9 justify-content-center mb-5">
          <div class="col-md-8 mb-md-5">
          <h2 class="text-center">Si vous avez des questions <br> n'hésitez pas à nous envoyer un message</h2>
            <form action="contacter.php" method="post" class="bg-light p-5 contact-form justify-content-center">
              <div class="form-group">
                <input type="text" name="nom" class="form-control" placeholder="Votre Nom">
              </div>
              <div class="form-group">
                <input type="text" name="email"class="form-control" placeholder="Votre Email">
              </div>
              <div class="form-group">
                <input type="text" name="subject" class="form-control" placeholder="Sujet">
              </div>
              <div class="form-group">
                <textarea name="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
              </div>
              <div class="form-group text-center">
              <input type="submit" value="Envoyer" class="form-control btn btn-primary">
             </div>
            </form>        
          </div>
        </div>  

    </section>

<?php include "./includes/footer.php"?>