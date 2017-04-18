<?php $this->layout('layout', ['title' => 'Message'])?>
<?php $this->start('main_content')?>
<div class="container" style="width: 390px">
<br>
<br>
  <?php if (!empty($errorsText)): ?>
  <div class="alert alert-danger"><?= $errorsText ?></div>
  <?php endif;if (!empty($successText)): ?>
  <div class="alert alert-success"><?= $successText ?></div>
  <?php endif;?>
  <div class="row">
  	<a href="<?=$this->url('users_listOrders')?>" class="btn btn-info" role="button">Liste de vos commandes</a>
  </div>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
<?php $this->insert('inc/_footer') ?>
<?php $this->stop('footer')?>
