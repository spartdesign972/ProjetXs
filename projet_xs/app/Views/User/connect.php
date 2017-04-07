<?php $this->layout('layout', ['title' => 'login']) ?>
<?php $this->start('main_content') ?>
<div class="container">
  <h3>Veuillez vous identifier pour acceder a cette page !</h3>
  <form method="post" id="add" action="<?=$this->url('login') ?>" class="form-horizontal jumbotron">
    
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" id="email" name="email" placeholder="votre@email.fr">
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control" type="password" id="password" name="password" placeholder="Un mot de passe super compliqué" required>
    </div>
    
    <div class="text-center">
      <input type="submit" id="submitForm" class="btn btn-default"></a>
    </div>
  </form>
</div>
<?php $this->stop('main_content') ?>
<?php $this->start('footer') ?>
<div class="foot">
  <div class="colored">
    <div class="row">
      <div class="container">
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
</div>
<?php $this->stop('footer') ?>