<?php $this->layout('layout', ['title' => 'Vos Designs'])?>
<?php $this->start('main_content')?>
<div id="content" class="container">
				<section class="row">
					<div class="container text-center">
    <div class="colored">
      <h1>Vos T-shirts personnalisés</h1>
      <div class="row">
        <?php foreach ($design as $designsFinal): ?>
        <div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
          <div class="thumbnail">
            <img src="<?=$designsFinal['picture_source'];?>" alt="">
            <div class="caption">
              <h3>Thumbnail label</h3>
              <p>...</p>
              <p><a href="#" class="btn btn-primary" role="button">Modifier</a> <a href="#" class="btn btn-default" role="button">Supprimer</a></p>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </div>
</section>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>

<?php $this->stop('footer')?>
