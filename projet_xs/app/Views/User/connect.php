<?php $this->layout('layout', ['title' => 'login']) ?>
<?php $this->start('main_content') ?>
<div class="container">
  
  <div class="row">
    <div class="col-xs-12">
      <div class="card-group ">
        <div class="card">
          <div class="card-block g-1 text-center">
            <h1 class="login-page">Login</h1>
            <p class="text-muted">Sign In to your account</p>
            <form method="post" id="add" action="<?=$this->url('login') ?>" class="form-horizontal">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input class="form-control" type="email" id="email" name="email" placeholder="votre@email.fr">
              </div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input class="form-control" type="password" id="password" name="password" placeholder="Votre mot de passe" required>
              </div>
              <div class="row">
                <div class="col-xs-6">
                  <input type="submit" id="submitForm" class="btn btn-primary"></input>
                </div>
                <div class="col-xs-6">
                  <a href="#" title="" class="btn btn-link">Forgot password?</a>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card card-inverse card-primary text-center" style="width:44%">
          <div class="card-block g-2 text-xs-center">
            <div>
              <h2 class="login-page">Sign up</h2>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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