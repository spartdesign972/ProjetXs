<?php $this->layout('layout', ['title' => 'login']) ?>
<?php $this->start('main_content') ?>
<div class="container">
  
  <div class="row">
  <?php if(!empty($errorsText)) : ?>

    <div class="alert alert-danger"><?= $errorsText ?></div>

  <?php endif; ?>

    <div class="col-xs-12">
      <div class="card-group ">
        <div class="card col-xs-12 col-sm-8">
          <div class="card-block text-center">
            <h1 class="login-page">Connexion</h1>
            <p class="text-muted">Accéder à votre compte</p>
            <form method="post" id="add" action="<?=$this->url('login') ?>" class="form-horizontal">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="text" id="email" name="email" placeholder="votre@email.fr">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control" type="password" id="password" name="password" placeholder="Votre mot de passe" required>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-6 text-left cx-submit">
                  <input type="submit" id="submitForm" class="btn btn-primary"></input>
                </div>
                <div class="col-xs-12 col-sm-6 text-right cx-mdp">
                  <a href="<?= $this->url('forgot_password') ?>" title="" class="btn btn-link">Mot de passe oublié ?</a>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card card-inverse card-primary col-xs-12 col-sm-4 text-center">
          <div class="card-block g-2 text-xs-center">
            <div>
              <h2 class="login-page">Inscription</h2>
              <p>Pas encore inscrit ? Inscrivez-vous en cliquant sur le lien ci-dessous pour pouvoir créer votre propre T-shirt !</p>
              <a href="<?=$this->url('default_subscribe') ?>" title="" class="btn btn-primary active">M'inscrire!</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<?php $this->stop('main_content') ?>
<?php $this->start('footer') ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer') ?>