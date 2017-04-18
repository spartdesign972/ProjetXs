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
										<input type="checkbox" name="confirmation" class="confirm" data-value="<?=$designsFinal['public']?>" href="<?=$this->url('user_publicDesign') ?>" data-id="<?=$designsFinal['id']; ?>" value="<?=$designsFinal['public']?>">
										<?php if($designsFinal['public'] == 1): ?>
											<span class="glyphicon glyphicon-ok"></span></label>
										<?php endif; ?>
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
		ajax_delete('a.deleteDesign', 'Effacer ce design');

		// // confirmation pour rendre public
		// $('body').on('click', '.confirm', function(e){
		// 		e.preventDefault();
		// 		var $this = $(this);
		// 		if($this.data('value') == 0){
		// 			var val = 1;
		// 			var mess = "Vous vous apprêter à rendre ce design public";
		// 		}else if($this.data('value') == 1){
		// 			var val = 0;
		// 			var mess = "Vous vous apprêter a ne plus rendre ce design publique";
		// 		}

		// 		swal({
		// 				title: mess,
		// 				text: "Voulez-vous continuer ?",
		// 				type: "info",
		// 				showCancelButton: true,
		// 				closeOnConfirm: false,
		// 				showLoaderOnConfirm: true
		// 				}, function () {
		// 						setTimeout(function () {
		// 								$.ajax({
		// 										method: 'post',
		// 										url: $this.attr('href'),
		// 										data: {confirm_id: $this.data('id'), state: val},
		// 										dataType: 'json',
		// 										success: function(result){
		// 												swal('', result.message, result.status);
		// 												location.reload();

		// 										}
		// 								});
		// 						}, 1);
		// 		});
		// });
});
</script>
<?php $this->stop('script')?>
