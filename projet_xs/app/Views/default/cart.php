<?php $this->layout('layout', ['title' => 'Votre Panier'])?>
<?php $this->start('main_content')?>


<div class="container">
<h1>Votre Panier</h1>
	<br>
<form method="post" action="">
<table class="table">
<thead>
	<tr>
		<td>Libellé</td>
		<td>Quantité</td>
		<td>Prix Unitaire</td>
		<td>Action</td>
	</tr>
</thead>
<tbody>
<?php foreach ($_SESSION['cart'] as $designsFinal): var_dump($_SESSION) ?>
<?php var_dump($w_user) ?>
	<tr>
				<td><div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
					<div class="thumbnail">
						<img src="<?=$this->assetUrl('upload/' . $designsFinal['image']);?>" alt="">
					</div>
				</div></td>


				<td><input class="form-control" type="number" min="1" name="qte"></td>
				<td></td>
				<td><p><a href="<?=$this->url('user_deleteDesign') ?>" class="btn btn-default deleteDesign" data-id="<?=$designsFinal['id']; ?>" role="button">Supprimer</a></p></td>
				
				</tr>
<?php endforeach;?>
</tbody>
</table>
</form>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
<?php include './inc/footer.php';?>
<?php $this->stop('footer')?>