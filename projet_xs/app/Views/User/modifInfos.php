<?php $this->layout('layout', ['title' => 'Mes informations'])?>
<?php $this->start('main_content')?>
<div class="container">
  <?php if (isset($userModif) && !empty($userModif)): ?>
  <form method="post" id="subscribe_form" action="<?=$this->url('default_modifInfos')?>"  class="form-horizontal jumbotron" enctype="multipart/form-data">
    <!-- Form Name -->
    <legend>Mes informations</legend>
    <div class="form-group">
      <label for="lastname">Nom</label>
      <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Votre nom.."  value="<?=$userModif['lastname'];?>">
    </div>
    <div class="form-group">
      <label for="firstname">Prénom</label>
      <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Votre prénom..."  value="<?=$userModif['firstname'];?>">
    </div>
    <div class="form-group">
      <label for="username">Pseudo</label>
      <input class="form-control" type="text" id="username" name="username" placeholder="Votre pseudo..."  value="<?=$userModif['username'];?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" type="email" id="email" name="email" placeholder="votre@email.fr"  value="<?=$userModif['email'];?>">
    </div>
    <div class="form-group">
      <label for="street">Rue</label>
      <input class="form-control" type="text" id="street" name="street" placeholder="Votre rue..."  value="<?=$userModif['street'];?>">
    </div>
    <div class="form-group">
      <label for="city">ville</label>
      <input class="form-control" type="text" id="city" name="city" placeholder="Votre ville..."  value="<?=$userModif['city'];?>">
    </div>
    <div class="form-group">
      <label for="zipcode">Code postal</label>
      <input class="form-control" type="text" id="zipcode" name="zipcode" placeholder="Votre code postal..."  value="<?=$userModif['zipcode'];?>">
    </div>
    <div class="form-group">
      <label for="country">Pays</label>
      <input class="form-control" type="text" id="country" name="country" placeholder="Votre pays..."  value="<?=$userModif['country'];?>">
    </div>
    <div class="form-group">
      <label for="avatar">Avatar</label>
      <input class="form-control" class="input-file" accept="image/*" type="file" id="avatar" name="avatar" placeholder="Votre Avatar..."  value="<?=$userModif['avatar'];?>">
    </div>
    <div class="form-group" style="margin-bottom: 0;">
      <div id="image_preview" class="col-lg-10 col-lg-offset-2">
        <div class="thumbnail hidden">
          <img src="http://placehold.it/5" alt=""  value="<?=$userModif['avatar'];?>">
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
  <?php else: ?>
  <p class="alert alert-danger" role="alert">Désolé, Vous n'êtes pas inscrit !!!</p>
  <?php endif;?>
  <br>
  <div id="result" style="width: 300px; margin-left: 430px"></div>
  <br>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
<?php $this->insert('inc/_footer') ?>
<?php $this->stop('footer')?>
<?php $this->start('script')?>
<script src="<?=$this->assetUrl('js/monJs.js')?>" type="text/javascript"></script>
<script src="<?=$this->assetUrl('js/ajaxInsert.js')?>" type="text/javascript"></script>
<?php $this->stop('script')?>
