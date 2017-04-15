<?php
//hérite du fichier layout.php à la racine de app/Views/
$this->layout('layout', ['title' => 'Le detail de votre commande'])
?>
<?php $this->start('main_content');?>
<div class="container">
  <div class="contact col-xs-12">
    <legend><h2>Détails de la commande</h2>
    </legend>
    <br>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Date de commande</th>
          <th>Commande N° :</th>
          <th>Produits : </th>
          <th>Etat de la commande :</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($view_order)): ?>
        <tr>
          <td><?=$view_order['date_create'];?></td>
          <td><?=$view_order['id'];?></td>
          <td><?=$view_order['products'];?></td>
          <td><?=$view_order['status'];?></td>
        </tr>
        <?php else: ?>
        Aucune commande trouvée !
        <?php endif;?>
      </tbody>
    </table>
  </div>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer'); ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer'); ?>