<?php $this->layout('layoutAdmin', ['title' => 'Contact']) ?>
<?php $this->start('main_content') ?>

	<br>
    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Date</th>
				<th>Expéditeur</th>
				<th>Sujet</th>
				<th>Etat</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($set) == 0) : ?>
				<tr><td colspan="5" class="danger text-danger text-center">Aucun message...</td></tr>
			<?php else : foreach ($set as $contact) : ?>
				<tr>
					<td><?= $contact['id'] ?></td>
					<td><?= $contact['date'] ?></td>
					<td><?= $contact['name'] ?></td>
					<td>
						<div class="form-group-sm">
							<select class=" form-control statusChange" data-id="<?= $contact['id'] ?>">
								<option value="lu"<?= ($contact['status'] == 'lu') ? ' selected' : '' ?>>Lu</option>
								<option value="non lu"<?= ($contact['status'] == 'non lu') ? ' selected' : '' ?>>Non lu</option>
							</select>
						</div>
					</td>
					<td><a href="<?= $this->url('admin_contact_details', ['id' => $contact['id']]) ?>">Lire</a></td>
					<td><a href="<?= $this->url('admin_delete_contact') ?>" class="deleteContact" data-id="<?= $contact['id'] ?>">Supprimer</a></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>

	<?= $this->insert('inc/_navigation', ['navigationUrl' => $this->url('admin_contacts'), 'page' => $page, 'total' => $total, 'limit' => $limit]) ?>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
<script>
	$(function(){

		$('li.disabled a').attr('href', '#');

        ajax_delete('a.deleteContact', 'Effacer ce message de contact ?');

		ajax_change('select.statusChange', '<?= $this->url('admin_contact_status') ?>');	

	});
</script>
<?php $this->stop('script') ?>
