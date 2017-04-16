<?php $this->layout('layout', ['title' => 'Vos commandes'])?>
<?php $this->start('main_content');?>
<h1></h1>
<div class="container">
	<div id="result"></div>
	<!-- En-Tête de Présentation -->
	<div class="contact col-xs-12">
		<h1>Les Commandes</h1>
		<br>
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Date de commande</th>
					<th>Commande</th>
					<th>Status</th>
					<th>Factures</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($Order as $viewOrder): ?>
				<tr>
					<td><?=$viewOrder['date_create'];?></td>
					<td><?='Commande N°: ' . $viewOrder['id'];?></td>
					<td><?=$viewOrder['status'];?></td>
					<td>
						<a href="<?=$this->url('users_viewOrder', ['id' => $viewOrder['id']])?>"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span>
						Visualiser cette commande</button>
					</a>
				</td>
		</tr>
		<?php endforeach;?>
	</tbody>
</table>
</div>
</div>
<?php $this->stop('main_content');?>
<?php $this->start('footer');?>
<?php include './inc/footer.php';?>
<?php $this->stop('footer');?>
<?php $this->start('script')?>
	<script>

 $(function(){

			// Supprimer une commande
            $('body').on('click', '.deleteOrder', function(e){
                e.preventDefault();

				var $this = $(this);
                swal({
                    title: "Effacer cette commande",
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
                                data: {order_id: $this.data('id')},
                                dataType: 'json',
                                success: function(result){
                                    swal('', result.message, result.status);
																		location.reload();
                                }
                            });
                        }, 1000);
                });
            });
          });
</script>
<?php $this->stop('script')?>
