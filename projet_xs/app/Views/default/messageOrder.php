<?php $this->layout('layout', ['title' => 'Message'])?>
<?php $this->start('main_content')?>
<div class="container" style="width: 370px">
<br>
<br>
  <?php if (!empty($errorsText)): ?>
  <div class="alert alert-danger"><?= $errorsText ?></div>
  <?php endif;if (!empty($successText)): ?>
  <div class="alert alert-success"><?= $successText ?></div>
  <?php endif;?>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
<?php include './inc/footer.php';?>
<?php $this->stop('footer')?>
