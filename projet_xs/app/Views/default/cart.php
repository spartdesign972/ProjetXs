<?php $this->layout('layout', ['title' => 'Votre Panier'])?>
<?php $this->start('main_content')?>
<div class="container">
	<h1>Votre Panier</h1>
	<br>
	<form method="post" action="">
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
				<?php foreach ($item as $designsFinal): ?>
				<tr>
					<td>
						<p><?=$designsFinal['libelleProduit'];?></p>
					</td>
					<td>
						<div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
							<div class="thumbnail">
								<img src="<?=$this->assetUrl('upload/' . $designsFinal['image']);?>" alt="">
							</div>
						</div>
					</td>
					<td>
						<input class="form-control" type="text" name="qte" value="<?=$designsFinal['qty'];?>">
					</td>
					<td><?php echo $designsFinal['prix']; ?></td>
					<td>
						<p><a href="<?=$this->url('user_deleteDesign')?>" class="btn btn-default deleteDesign" data-id="<?=$designsFinal['id'];?>" role="button">Supprimer</a></p>
					</td>
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
<?php $this->start('script')?>
<script>
$(function(){
		// Supprimer un design
					$('body').on('click', '.deleteDesign', function(e){
							e.preventDefault();
			var $this = $(this);
							swal({
									title: "Effacer ce design",
									text: "Voulez-vous continuer ?",
									type: "info",
									showCancelButton: true,
									closeOnConfirm: false,
									showLoaderOnConfirm: true
									}, function () {
											setTimeout(function () {
													$.ajax({
															method: 'post',
															url: $this.attr('href'),
															data: {design_id: $this.data('id')},
															dataType: 'json',
															success: function(result){
																	swal('', result.message, result.status);
															}
													});
											}, 1000);
							});
					});
			});
</script>
<?php $this->stop('script')?>