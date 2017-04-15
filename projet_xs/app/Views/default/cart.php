<?php $this->layout('layout', ['title' => 'Votre Panier'])?>
<?php $this->start('main_content')?>
<div class="container">
	<h1>Votre Panier</h1>
	<br>
	<?php if(!empty($emptyCart)) : ?>
		<div class="alert alert-info"><?= $emptyCart ?></div>
	<?php else : ?>

		<table class="table jumbotron">
			<thead>
				<tr>
					<td>Libellé</td>
					<td>Produit</td>
					<td>Quantité</td>
					<td>Prix Unitaire</td>
					<td>Action</td>
				</tr>
			</thead>
			<tbody>
				<?php if(isset($_SESSION['cart'])) : for($i=0; $i < count($_SESSION['cart']['id']); $i++) : ?>
					<tr>
						<td><p><?=$_SESSION['cart']['libelleProduit'][$i]; ?></p></td>
						<td>
							<div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
								<div class="thumbnail">
									<img src="<?=$this->assetUrl('upload/' . $_SESSION['cart']['image'][$i]);?>" alt="">
								</div>
							</div>
						</td>
						<td>
							<input class="form-control editQty" type="number" min="1" name="qte" data-id="<?=$_SESSION['cart']['id'][$i];?>" value="<?=$_SESSION['cart']['qty'][$i];?>">
						</td>
						<td class="designPrice"><?= $_SESSION['cart']['price'][$i] * $_SESSION['cart']['qty'][$i] ?></td>
						<td>
							<p><a href="<?=$this->url('cart_remove_design')?>" class="btn btn-default removeDesign" data-id="<?=$_SESSION['cart']['id'][$i];?>" role="button"><i class="fa fa-trash-o" aria-hidden="true"></i></a></p>
						</td>
					</tr>
				<?php endfor; endif; ?>
				<tr class="total">
					<td><strong>TOTAL</strong></td>
					<td><strong><?=array_sum($_SESSION['cart']['price']) ?> &euro;</strong></td>
				</tr>				
			</tbody>
		</table>
		<div class="row">
			<a href="<?=$this->url('user_listDesigns')?>" class="btn btn-info"  role="button">Continuer vos achats</a>
			<a href="<?=$this->url('user_listDesigns')?>" class="btn btn-info"  role="button">Commander</a>
		</div>

	<?php endif; ?>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
<?php include './inc/footer.php';?>
<?php $this->stop('footer')?>
<?php $this->start('script')?>
<script>
$(function(){
		// Modifier une quantité
		$('body').on('change', 'input.editQty', function(e){
			e.preventDefault();

			var $this = $(this);
			$.ajax({
				method: 'post',
				url: '<?= $this->url('cart_edit_qty') ?>',
				data: {design_id: $this.data('id'), qty: $this.val()},
				dataType: 'json',
				success: function(result){
					// swal('', result.message, result.status);
					location.reload();
				}
			});
		});

		// Rétirer un design
		$('body').on('click', 'a.removeDesign', function(e){
			e.preventDefault();

			var $this = $(this);
			$.ajax({
				method: 'post',
				url: $this.attr('href'),
				data: {design_id: $this.data('id')},
				dataType: 'json',
				success: function(result){
					// swal('', result.message, result.status);
					location.reload();
				}
			});
		});


});
</script>
<?php $this->stop('script')?>