<?php
//hérite du fichier layout.php à la racine de app/Views/
$this->layout('layout', ['title' => 'Le detail de votre commande'])

?>


<?php $this->start('main_content');?>
<div class="container">



  <legend><h2>Détails de la commande</h2>
  </legend>

  <?php if (!empty($view_order)): ?>


    <p><?php echo 'Commande N° : ' .$view_order['id']; ?></p>
    <p><?php echo 'Commande crée le : ' .$view_order['date_create']; ?></p>
    <p><?php echo 'Produits : ' .$view_order['products']; ?></p>
    <p><?php echo 'Etat de la commande : '  .$view_order['status']; ?></p>

  <?php else: ?>
    Aucune commande trouvée !
  <?php endif;?>
  </div>
  <?php $this->stop('main_content')?>
  <?php $this->start('footer'); ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer'); ?>



