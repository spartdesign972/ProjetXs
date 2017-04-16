<?php $this->layout('layout', ['title' => 'Accueil']) ?>
<?php $this->start('main_content') ?>
<!--
******************************** le slider *********************************
-->
<div class="carousel-wrapper hidden-xs">
  <div class="carousel-position">
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
          <img src="<?= $this->assetUrl('img/heart.jpg') ?>" alt="Chania" class="img-responsive">
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
  </div>
</div>
<!--*************************** fin slider *******************************-->
<!--
*************************** section presentation *************************
-->
<section class="presentation">
  <div class="container">
    <div class="colored">
      <div class="row">
        <div class="col-xs-12 col-sm-8 text-center">
          <h1>Bienvenue sur Shirt Factory !</h1>
          <p>Ici vous pourrez laisser libre cours à votre imagination et créer votre propre T-shirt ! Envie d'en savoir plus ? N'attendez pas et cliquez sur le lien ci-dessous !</p>
          <br>
          <a href="<?=$this->url('default_custom')?>" title="" id="makeit"></a>
          <br>
          <div id="btnmakit"><a href="#" title="" class="btn btn-primary">Réaliser</a></div>

        </div>
        <div class="col-xs-12 col-sm-4 hidden-xs text-center">
          <div class="wow slideInLeft">
            <img src="<?= $this->assetUrl('img/img_pres1.jpg') ?>" alt="" class="img-thumbnail">
            <img src="<?= $this->assetUrl('img/img_pres2.jpg') ?>" alt="" class="img-thumbnail">
          </div>
          <div class="wow slideInRight">
            <img src="<?= $this->assetUrl('img/img_pres3.jpg') ?>" alt="" class="img-thumbnail">
            <img src="<?= $this->assetUrl('img/img_pres4.jpg') ?>" alt="" class="img-thumbnail">
          </div>
          <div class="wow slideInLeft">
            <img src="<?= $this->assetUrl('img/img_pres5.jpg') ?>" alt="" class="img-thumbnail">
            <img src="<?= $this->assetUrl('img/img_pres6.jpg') ?>" alt="" class="img-thumbnail">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--*************************** fin presentation *******************************-->
<!--
*************************** section how to *************************
-->
<section class="howto">
  <div class="container text-center wow bounceInUp">
    <h1>Comment créer votre tshirt ?</h1>
    <p>Du mal a créer votre T-shirt idéal ? Ne paniquez pas et suivez juste ces quelques petites étapes !</p>
    <div class="row">
      <div class="col-xs-6 col-sm-3"><h3>etape 1</h3></div>
      <div class="col-xs-6 col-sm-3"><h3>etape 2</h3></div>
      <div class="col-xs-6 col-sm-3"><h3>etape 3</h3></div>
      <div class="col-xs-6 col-sm-3"><h3>etape 4</h3></div>
    </div>
  </div>
</section>
<!--*************************** fin how to *******************************-->
<!--
*************************** section selection *************************
-->
<section class="selection">
  <div class="container text-center">
    <div class="colored">
      <h1>Sélection de la semaine</h1>
      <div class="row">

        <div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
          <div class="thumbnail">
            <img src="<?= $this->assetUrl('img/sel1.jpg') ?>" alt="">
            <div class="caption">

              <h3>Thumbnail label</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-default" role="button">Voir le produit</a></p>

              <h3>Design label</h3>
              <p class="design-author-name">par <a href="#" title="">XXXX</a></p>
              <div class="row">
                <p class="col-xs-6 text-left nb-like">100 <i class="fa fa-heart" aria-hidden="true"></i></p>
                <p class="col-xs-6 text-right"><a href="#" class="btn btn-default" role="button">Like <i class="fa fa-heart like-yes" aria-hidden="true"></i>
</a></p>
              </div>

            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
          <div class="thumbnail">
            <img src="<?= $this->assetUrl('img/sel2.jpg') ?>" alt="">
            <div class="caption">

              <h3>Thumbnail label</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-default" role="button">Voir le produit</a></p>

              <h3>Design label</h3>
              <p class="design-author-name">par <a href="#" title="">XXXX</a></p>
              <div class="row">
                <p class="col-xs-6 text-left nb-like">250 <i class="fa fa-heart" aria-hidden="true"></i></p>
                <p class="col-xs-6 text-right"><a href="#" class="btn btn-default" role="button">Like <i class="fa fa-heart like-yes" aria-hidden="true"></i>
</a></p>
              </div>
            </div>
          </div>
        </div>

        <?php foreach($productsSelection as $product) : ?>

        <div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
          <div class="thumbnail">
            <img src="<?= $this->assetUrl('upload/' .$product['model']) ?>" alt="">
            <div class="caption">

              <h3 class="text-center"><?= $product['design_label'] ?></h3>
              <p class="design-author-name">Créer par : <a href="<?= $this->url('default_membredesignmembre', ['id'=>$product['user_id']]); ?>" title=""><?= $product['username'] ?></a></p>
              <!-- <p><a href="#" class="btn btn-default" role="button">Voir le produit</a></p> -->

              <div class="row">
                <p class="col-xs-6 text-left nb-like"><?= $product['likes_count'] ?> <i class="fa fa-heart" aria-hidden="true"></i></p>
                <?php if(!empty($w_user)) : ?>
                  <p class="col-xs-6 text-right my-like" data-user="<?= $w_user['id'] ?>" data-id="<?=$product['id'] ?>"></p>
                  <p class="col-xs-12 text-center"><a href="<?=$this->url('cart_createcart', ['id' => $product['id']]) ?>" class="btn btn-default addCart" role="button">Ajouter au panier</a></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>
  </div>
</div>
</div>
</section>
<!--*************************** fin selection *******************************-->
<div class="clearfix"></div>


<?php $this->stop('main_content') ?>
<?php $this->start('footer') ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer') ?>
