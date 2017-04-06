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
      <img src="<?= $this->assetUrl('img/heart.jpg') ?>" alt="Chania">
    </div>

    <div class="item">
      <img src="<?= $this->assetUrl('img/wall2.jpg') ?>" alt="Chania">
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
              <br>
              <a href="#" title="" id="makeit"></a>
              <br>
              <div id="btnmakit"><a href="#" title="" class="btn btn-primary">Réaliser</a></div>
              
						</div>
            <div class="col-xs-12 col-sm-4 hidden-xs text-center">
              <img src="<?= $this->assetUrl('img/img_pres1.jpg') ?>" alt="" class="img-thumbnail">
              <img src="<?= $this->assetUrl('img/img_pres2.jpg') ?>" alt="" class="img-thumbnail">
              <img src="<?= $this->assetUrl('img/img_pres3.jpg') ?>" alt="" class="img-thumbnail">
              <img src="<?= $this->assetUrl('img/img_pres4.jpg') ?>" alt="" class="img-thumbnail">
              <img src="<?= $this->assetUrl('img/img_pres5.jpg') ?>" alt="" class="img-thumbnail">
              <img src="<?= $this->assetUrl('img/img_pres6.jpg') ?>" alt="" class="img-thumbnail">
            </div>
					</div>
				</div>
			</div>
	</section>

  <section class="howto">
    <div class="colored">
      <div class="container text-center">
        <h1>Comment creer votre tshirt ?!</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae velit sit, quae debitis ea ratione ex excepturi rem vero sequi enim minus inventore nulla et aut, laboriosam optio, officia. Iusto!</p>
        <div class="row">
          <div class="col-xs-6 col-sm-3"><h3>etape 1</h3></div>
          <div class="col-xs-6 col-sm-3"><h3>etape 2</h3></div>
          <div class="col-xs-6 col-sm-3"><h3>etape 3</h3></div>
          <div class="col-xs-6 col-sm-3"><h3>etape 4</h3></div>
        </div> 
      </div>
    </div>
  </section>

  <section class="selection">
    <div class="container text-center">
      <h1>Sélection de la semaine</h1>
      <div class="row">
        
        <div class="col-sm-12 col-md-4">
          <div class="thumbnail">
            <img src="<?= $this->assetUrl('img/sel1.jpg') ?>"" alt="">
            <div class="caption">
              <h3>Thumbnail label</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-4">
          <div class="thumbnail">
            <img src="<?= $this->assetUrl('img/sel2.jpg') ?>"" alt="">
            <div class="caption">
              <h3>Thumbnail label</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-4">
          <div class="thumbnail">
            <img src="<?= $this->assetUrl('img/sel3.jpg') ?>"" alt="">
            <div class="caption">
              <h3>Thumbnail label</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-primary" role="button">Button</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
            </div>
          </div>
        </div>

      </div>
      </div>
      </div>
    </div>
  </section>

  <section class="infos">
    <div class="container text-center">
      <h1>Flash info !</h1>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum odit, exercitationem molestiae quaerat expedita blanditiis, dolores eos nobis numquam nisi, fuga architecto aliquid a vitae laborum officia ratione enim quos.</p>
    </div>

  </section>
<?php $this->stop('main_content') ?>

<?php $this->start('footer') ?>
<div class="foot">
  <div class="colored">
    <div class="row">
      
      <div class="col-xs-12 col-sm-4">
        <h2>Qui somme nous !</h2><hr>
        <p>Tshirt Factory XS <br>
        21 rue des Rosier <br>
        97200 Fort de France, Martinique <br>
        tsfxs@orange.fr <br>
        0596 25 36 65</p>
      </div>
      
      <div class="col-xs-12 col-sm-4">
        <h2>Nous Suivre !</h2><hr>
        <ul>
          <li><a href="#"></a>Facebook</li>
          <li><a href="#"></a>Twitter</li>
          <li><a href="#"></a>Instagram</li>
          <li><a href="#"></a>Pinterest</li>
        </ul>
      </div>
      
      <div class="col-xs-12 col-sm-4">
        <h2></h2><hr>
      </div>

    </div>
  </div>
</div>
<?php $this->stop('footer') ?>
