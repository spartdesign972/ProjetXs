<?php $this->layout('layout', ['title' => 'login'])?>
<?php $this->start('main_content')?>
<div class="container">
<div id="rtesult"></div>

    <form method="post" id="add" action="<?=$this->url('default_subscribe') ?>" class="form-horizontal jumbotron" enctype="multipart/form-data">

    <div class="form-group">
      <label for="lastname">Nom</label>
      <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Votre prénom.." required>
    </div>

    <div class="form-group">
      <label for="firstname">Prénom</label>
      <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Votre prénom..." required>
    </div>

    <div class="form-group">
      <label for="username">Pseudo</label>
      <input class="form-control" type="text" id="username" name="username" placeholder="Votre prénom..." required>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" id="email" name="email" placeholder="votre@email.fr">
    </div>

    <div class="form-group">
      <label for="password">Mot de passe</label>
      <input class="form-control" type="password" id="password" name="password" placeholder="Un mot de passe... " required>
    </div>

    <div class="form-group">
      <label for="street">Rue</label>
      <input class="form-control" type="text" id="street" name="street" placeholder="Votre rue..." required>
    </div>

    <div class="form-group">
      <label for="city">ville</label>
      <input class="form-control" type="text" id="city" name="city" placeholder="Votre ville..." required>
    </div>

    <div class="form-group">
      <label for="zipcode">Code postal</label>
      <input class="form-control" type="text" id="zipcode" name="zipcode" placeholder="Votre code postal..." required>
    </div>

    <div class="form-group">
      <label for="country">Pays</label>
      <input class="form-control" type="text" id="country" name="country" placeholder="Votre pays..." required>
    </div>

    <div class="form-group">
      <label for="avatar">Avatar</label>
      <input class="form-control" class="input-file" type="file" id="avatar" name="avatar" placeholder="Votre Avatar..." required>
    </div>

    <div class="form-group" style="margin-bottom: 0;">
    <div id="image_preview" class="col-lg-10 col-lg-offset-2">
      <div class="thumbnail hidden">
        <img src="http://placehold.it/5" alt="">
        <div class="caption">
          <h4></h4>
          <p></p>
          <p><button type="button" class="btn btn-default btn-danger">Annuler</button></p>
        </div>
      </div>
    </div>
  </div>

    <div class="form-group">
      <button type="submit" id="submitForm" class="btn btn-primary">Envoyer</button>
    </div>

  </form>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
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
<?php $this->stop('footer')?>
<?php $this->start('script')?>
<script src="<?=$this->assetUrl('js/monJs.js')?>" type="text/javascript"></script>
<?php $this->stop('script')?>