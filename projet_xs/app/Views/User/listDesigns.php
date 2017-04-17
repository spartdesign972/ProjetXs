<?php $this->layout('layout', ['title' => 'Vos Designs'])?>
<?php $this->start('main_content')?>
<div id="content" class="container">
	<br>
	<div class="result"></div>
	<br>
	<section class="row">
		<div class="container text-center">
			<div class="colored">
				<h1>Liste de vos T-shirts </h1>
				<div class="row">
					<?php foreach ($design as $designsFinal): ?>
					<div class="col-sm-12 col-md-4 wow fadeInUp" data-wow-offset="200">
						<div class="thumbnail">
							<img src="<?=$this->assetUrl('upload/' . $designsFinal['model']);?>" alt="">
							<div class="caption">
								<h3><?=$designsFinal['design_label'] ?></h3>
								<p>
									<label class="btn btn-warning">
										<input type="checkbox" name="confirmation" class="confirm" value="1" href="<?=$this->url('user_publicDesign') ?>" data-id="<?=$designsFinal['id']; ?>">
										<span class="glyphicon glyphicon-ok"></span></label>
								</p>
								<p><a href="<?=$this->url('cart_createcart', ['id' => $designsFinal['id']]) ?>" class="btn btn-default addCart" role="button">Ajouter au panier</a></p>
								<p><a href="<?=$this->url('user_deleteDesign') ?>" class="btn btn-default deleteDesign" data-id="<?=$designsFinal['id']; ?>" role="button">Supprimer</a></p>
							</div>
						</div>
					</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
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
																	location.reload();

															}
													});
											}, 1000);
							});
					});


					// confirmation pour rendre public
					$('body').on('click', '.confirm', function(e){
							e.preventDefault();
							var $this = $(this);
							swal({
									title: "Vous vous apprêter à rendre ce design public",
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
															data: {confirm_id: $this.data('id')},
															dataType: 'json',
															success: function(result){
																	swal('', result.message, result.status);
																	// location.reload();

															}
													});
											}, 1000);
							});
					});
			});
</script>
<?php $this->stop('script')?>
