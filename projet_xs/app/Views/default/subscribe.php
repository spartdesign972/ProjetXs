<?php $this->layout('layout', ['title' => 'login'])?>
<?php $this->start('main_content')?>
<div class="container">
  <br>
  <?php if (isset($errors) && count($errors) > 0): ?>
  <div class="alert alert-danger"><?=implode('<br>', $errors);?></div>
  <?php elseif (isset($success) && $success == true): ?>
  <div class="alert alert-success">Le formulaire a été validé.</div>
  <?php endif;?>
  <div class="col-xs-12">
    <div class="colored-form">
      <form method="post" id="subscribe_form" action="<?=$this->url('default_subscribe')?>" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
          <label for="lastname">Nom</label>
          <input class="form-control" type="text" id="lastname" name="lastname" placeholder="Votre nom.." required>
        </div>
        <div class="form-group">
          <label for="firstname">Prénom</label>
          <input class="form-control" type="text" id="firstname" name="firstname" placeholder="Votre prénom..." required>
        </div>
        <div class="form-group">
          <label for="username">Pseudo</label>
          <input class="form-control" type="text" id="username" name="username" placeholder="Votre pseudo..." required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input class="form-control" type="email" id="email" name="email" placeholder="votre@email.fr">
        </div>
        <div class="form-group">
          <label for="password">Mot de passe (minimum 8 caratéres)</label>
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
          <input class="form-control" class="input-file" accept="image/*" type="file" id="avatar" name="avatar" placeholder="Votre Avatar..." required>
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
  </div>
  <?php $this->stop('main_content')?>
  <?php $this->start('footer')?>
  <?php include './inc/footer.php'; ?>
  <?php $this->stop('footer')?>
  <?php $this->start('script')?>
  <script src="<?=$this->assetUrl('js/monJs.js')?>" type="text/javascript"></script>
  <script src="<?=$this->assetUrl('js/ajaxInsert.js')?>" type="text/javascript"></script>
  <?php $this->stop('script')?>