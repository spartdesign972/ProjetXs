<?php $this->layout('layout', ['title' => 'Vos commandes']) ?>
<?php $this->start('main_content'); ?>

	<h1></h1>
	<!-- En-Tête de Présentation -->
	<div class="contact col-xs-12">
		<h1>Les Commandes</h1>
		<br>
		<table class="table">
			<thead>
				<tr>
					<th>Date de commande</th>
					<th>Commande</th>
					<th>Status</th>
					<th>Factures</th>
				</tr>
			</thead>
			<?php foreach($Order as $viewOrder): ?>
			<tbody>
				<tr>
					<td><?=$viewOrder['date_create'];?></td>
					<td><?='Commande N°: ' . $viewOrder['id'];?></td>
					<td><?=$viewOrder['status'];?></td>
					<td>
						<a href="<?=$this->url('users_viewOrder')?>"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span>
						Visualiser cette commande</button>
					</a>
				</td>
				<td>
					<a href="admin/modif_recipe.php?id=<?=$viewOrder['id'];?>">
						<button type="button" class="btn btn-info btn-sm">
						<span class="glyphicon glyphicon-edit"></span> Modifier
						</button>
					</a>
				</td>
				<td>
					<a href="admin/delete_recipe.php?id=<?=$viewOrder['id'];?>"><button type="button" class="btn btn-info btn-sm">
						<span class="glyphicon glyphicon-remove"></span>Remove</button>
					</a>
				</td>
			</tr>
		</tbody>
		<?php endforeach; ?>
	</table>
</div>

<?php $this->stop('main_content'); ?>
<?php $this->start('footer'); ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer'); ?>