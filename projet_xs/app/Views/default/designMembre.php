<?php $this->layout('layout', ['title' => 'Design des membres']) ?>
<?php $this->start('main_content') ?>
<!--
******************************** le slider *********************************
-->
<div class="container">
  <div class="row">
  <?php var_dump($nbDesign); ?><br>

  <p>Nombre de design en base : <?=$nbDesign['total'] ?> </p>
    <p class="col-xs-12 text-center">Trier par :
      <a href="<?= $this->url('default_designmembre', ['column' => 'username','ord' => 'asc' ]); ?>" class="btn btn-info">Pseudo <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
      <a href="<?= $this->url('default_designmembre', ['column' => 'username','ord' => 'desc' ]); ?>" class="btn btn-primary">Pseudo <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      <a href="<?= $this->url('default_designmembre', ['column' => 'like','ord' => 'asc' ]); ?>" class="btn btn-info">Like <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
      <a href="<?= $this->url('default_designmembre', ['column' => 'like','ord' => 'desc' ]); ?>" class="btn btn-primary">Like <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      <a href="<?= $this->url('default_designmembre', ['column' => 'date','ord' => 'asc' ]); ?>" class="btn btn-info">Date <i class="fa fa-arrow-down" aria-hidden="true"></i></a>
      <a href="<?= $this->url('default_designmembre', ['column' => 'date','ord' => 'desc' ]); ?>" class="btn btn-primary">Date <i class="fa fa-arrow-up" aria-hidden="true"></i></a>
    </p>
  </div>
  <div class="colored">
    <h1 class="text-center">Liste des design</h1>
    <div class="row">
      <?php foreach ($design as $designsFinal): ?>
      <div class="col-sm-12 col-md-3 wow fadeInUp" data-wow-offset="200">
        <div class="thumbnail">
          <img src="<?=$this->assetUrl('upload/' . $designsFinal['model']);?>" alt="">
          <div class="caption">
            <h3 class="text-center"><?= $designsFinal['design_label'] ?></h3>
            <p class="design-author-name">Créer par : <a href="<?= $this->url('default_membredesignmembre', ['id'=>$designsFinal['user_id']]); ?>" title=""><?= $designsFinal['username'] ?></a></p>
            <div class="row">
              <p class="col-xs-6 text-left nb-like"><?= $designsFinal['likes_count'] ?> <i class="fa fa-heart" aria-hidden="true"></i></p>
               <?php if(!empty($w_user)) : ?>
             <p class="col-xs-6 text-right my-like" data-user="<?= $w_user['id'] ?>" data-id="<?= $designsFinal['id'] ?>"></p>
              </a></p>
              <p class="text-center"><a href="<?=$this->url('cart_createcart', ['id' => $designsFinal['id']]) ?>" class="btn btn-default addCart" role="button">Ajouter au panier</a></p>
                <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
      <?php endforeach;?>
    </div>
  </div>
</div>
<?php $this->stop('main_content') ?>
<?php $this->start('footer') ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer') ?>
