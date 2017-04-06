<?php $this->layout('layout', ['title' => 'login']) ?>
<?php $this->start('main_content') ?>
<div class="container">
    <form method="post" class="form-horizontal jumbotron" id="form_register">
    <div class="form-group">
      <label for="firstname">Prénom</label>
      <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Votre prénom.." required>
    </div>
    <div class="form-group">
      <label for="lastname">Nom</label>
      <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Votre nom de famille.." required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" id="email" name="email" placeholder="votre@email.fr">
    </div>
    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control" type="password" id="password" name="password" placeholder="Un mot de passe super compliqué" required>
    </div>
    <div class="form-group">
      <label for="role">Rôle</label>
      <select class="selectpicker" id="role" name="role"  required>
        
      </select>
    </div>
    <div class="text-center">
      <a href="#" class="btn btn-default sendUser" data-url="">Enregistrer</a>
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