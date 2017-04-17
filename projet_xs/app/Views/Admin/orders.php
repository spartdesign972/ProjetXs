<?php $this->layout('layoutAdmin', ['title' => 'Commandes']) ?>
<?php $this->start('main_content') ?>

	<br>
    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Nom du client</th>
				<th>Prénom du client</th>
				<th>Etat</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($set) == 0) : ?>
				<tr><td colspan="5" class="danger text-danger text-center">Aucune commande...</td></tr>
			<?php else : foreach ($set as $order) : ?>
				<tr>
					<td><?= $order['id'] ?></td>
					<td><?= $order['date_create'] ?></td>
					<td><?= $order['lastname'] ?></td>
					<td><?= $order['firstname'] ?></td>
					<td>
						<div class="form-group-sm">
							<select class=" form-control statusChange" data-id="<?= $order['id'] ?>">
								<option value="en cours"<?= ($order['status'] == 'en cours') ? ' selected' : '' ?>>En cours</option>
								<option value="pret"<?= ($order['status'] == 'pret') ? ' selected' : '' ?>>Prête</option>
								<option value="livre"<?= ($order['status'] == 'livre') ? ' selected' : '' ?>>Livrée</option>
								<option value="annule"<?= ($order['status'] == 'annule') ? ' selected' : '' ?>>Annulée</option>
							</select>
						</div>
					</td>
					<td><a href="<?= $this->url('admin_showadmin') ?>/order-details/<?= $order['id'] ?>">Visualiser</a></td>
					<td><a href="<?= $this->url('admin_send_order') ?>" class="mailOrder" data-id="<?= $order['user_id'] ?>">Envoyer</a></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>

	<?= $this->insert('inc/_navigation', ['navigationUrl' => $this->url('admin_orders'), 'page' => $page, 'total' => $total, 'limit' => $limit]) ?>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
<script>
	$(function(){

		$('li.disabled a').attr('href', '#');

		ajax_change('select.statusChange', '<?= $this->url('admin_change_status') ?>');
	
		// Envoi un mail
		mail_order();

	});

</script>
<?php $this->stop('script') ?>
