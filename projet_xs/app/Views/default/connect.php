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
  <?php include './inc/footer.php'; ?>
<?php $this->stop('footer') ?>