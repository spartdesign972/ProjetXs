<?php $this->layout('layoutAdmin', ['title' => 'Utilisateurs']) ?>
<?php $this->start('main_content') ?>

	<br>
    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Avatar</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Pseudo</th>
				<th>Email</th>
				<th>Rôle</th>
				<th>Adresse</th>
				<th>Code postal</th>
				<th>Ville</th>
				<th>Pays</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($set) == 0) : ?>
				<tr><td class="danger text-danger text-center">Aucun utilisateur...</td></tr>
			<?php else : foreach ($set as $user) : ?>
				<tr>
					<td><?= $user['id'] ?></td>
					<td><img height="50" class="thumbnail" src="<?= $this->assetUrl('avatars').'/'.$user['avatar'] ?>" alt=""></td>
					<td><?= $user['lastname'] ?></td>
					<td><?= $user['firstname'] ?></td>
					<td><?= $user['username'] ?></td>
					<td><?= $user['email'] ?></td>
					<td>
						<div class="form-group-sm">
							<select class="form-control roleChange" data-id="<?= $user['id'] ?>"<?= ($user['id'] == $w_user['id']) ? ' disabled' : '' ?>>
								<option value="admin"<?= ($user['role'] == 'admin') ? ' selected' : '' ?>>Administrateur</option>
								<option value="user"<?= ($user['role'] == 'user') ? ' selected' : '' ?>>Utilisateur</option>
							</select>
						</div>
					</td>
					<td><?= $user['street'] ?></td>
					<td><?= $user['zipcode'] ?></td>
					<td><?= $user['city'] ?></td>
					<td><?= $user['country'] ?></td>
					<td><a href="<?= $this->url('admin_delete_user') ?>" class="deleteUser" data-id="<?= $user['id'] ?>">Supprimer</a></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>

	<?php 	$navigationUrl = $this->url('admin_users'); 
			include '_navigation.php'; ?>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
        $(function(){

			change_role('<?= $this->url('admin_change_role') ?>');

			ajax_delete('a.deleteUser', 'Effacer cet utilisateur');

        });
	</script>
<?php $this->stop('script') ?>
