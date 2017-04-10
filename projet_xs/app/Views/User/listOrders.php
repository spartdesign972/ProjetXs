<?php $this->layout('layout', ['title' => 'Vos commandes']) ?>
<?php $this->start('main_content'); ?>
<div class="container">

<h1></h1>
<!-- En-Tête de Présentation -->

<div class="contact col-xs-12">

<h1 class="list">Les Commandes</h1>

	<br>

	<table class="table">

		<thead>
			<tr>
				<th class="list">Date de commande</th>
				<th class="list">Commande</th>
				<th class="list">Status</th>
				<th class="list">Factures</th>
			</tr>
		</thead>
		<?php foreach($Order as $viewOrder): ?>
		<tbody>

				<tr>
					<td class="list"><?=$viewOrder['date_create'];?></td>
					<td class="list"><?='Commande N°: ' . $viewOrder['id'];?></td>
					<td class="list"><?=$viewOrder['status'];?></td>

					<td>
						<a href="<?=$this->url('#')?>"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span>
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

</div>

<?php $this->stop('main_content'); ?>
<?php $this->start('footer'); ?>
<?php include './inc/footer.php'; ?>
<?php $this->stop('footer'); ?>
