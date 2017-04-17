<?php $this->layout('layoutAdmin', ['title' => 'Produits']) ?>
<?php $this->start('main_content') ?>

	<br>
	<div class="clearfix">
		<a href="<?=$this->url('admin_add_product');?>" class="btn btn-default pull-left">Ajouter un produit</a>
	</div>

    <div class="result"></div>
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Référence</th>
				<th>Taille</th>
				<th>Couleur</th>
				<th>Catégorie</th>
				<th>Notes</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($set) == 0) : ?>
				<tr><td class="danger text-danger text-center">Aucun produit...</td></tr>
			<?php else : foreach ($set as $product) : ?>
				<tr>
					<td><?= $product['id'] ?></td>
					<td><?= $product['reference'] ?></td>
					<td><?= $product['size'] ?></td>
					<td><?= $product['color'] ?></td>
					<td><?= $product['name'] ?></td>
					<td><?= $product['note'] ?></td>
					<!--<td><a href="<?= $this->url('admin_showadmin') ?>/product-details/'+value.id+'">Visualiser</a></td>-->
					<!--<td><a href="<?= $this->url('admin_showadmin') ?>/edit-product/'+value.id+'">Modifier</a></td>-->
					<td><a href="<?= $this->url('admin_delete_product') ?>" class="deleteProduct" data-id="<?= $product['id'] ?>">Supprimer</a></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>

	<?= $this->insert('inc/_navigation', ['navigationUrl' => $this->url('admin_products'), 'page' => $page, 'total' => $total, 'limit' => $limit]) ?>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
        $(function(){

			$('li.disabled a').attr('href', '#');

			ajax_delete('a.deleteProduct', 'Effacer ce produit');

        });
	</script>
<?php $this->stop('script') ?>
