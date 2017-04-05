<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
    <li data-target="#myCarousel" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img src="<?= $this->assetUrl('img/heart.jpg') ?>" alt="Chania" >
    </div>

    <div class="item">
      <img src="<?= $this->assetUrl('img/heart.jpg') ?>" alt="Chania">
    </div>

    <div class="item">
      <img src="<?= $this->assetUrl('img/heart.jpg') ?>" alt="Flower">
    </div>

    <div class="item">
      <img src="<?= $this->assetUrl('img/heart.jpg') ?>" alt="Flower">
    </div>
  </div>

  <!-- Left and right controls -->
  <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

	<section class="presentation">
			<div class="colored">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-8 text-center">
							<h1>Bonjour, comment tu t'appel ?</h1>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione iure amet praesentium libero alias autem voluptas dolor facere. Ad, debitis, fugiat molestiae adipisci nemo odio! Rerum sapiente nostrum pariatur, velit!</p>
						</div>
					</div>
				</div>
			</div>
	</section>

  <section class="howto">
    <div class="colored">
      <div class="container">
        <h1>Comment creer votre tshirt ?!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae velit sit, quae debitis ea ratione ex excepturi rem vero sequi enim minus inventore nulla et aut, laboriosam optio, officia. Iusto!</p> 
      </div>
    </div>
  </section>

  <section class="selection">
    <h1>Sélection de la semaine</h1>

    
  </section>

  <section class="infos">
    <h1>Flash info !</h1>

  </section>
<?php $this->stop('main_content') ?>

<?php $this->start('footer') ?>


<?php $this->stop('footer') ?>
