<?php $this->layout('layoutAdmin', ['title' => 'Catégories']) ?>
<?php $this->start('main_content') ?>

	<br>
	<div class="clearfix">
		<a href="<?=$this->url('admin_add_category');?>" class="btn btn-default pull-left">Ajouter une catégorie</a>
	</div>
    
    <br>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Image</th>
				<th>Libellé</th>
				<th>Référence</th>
				<th>Nom</th>
				<th>Description</th>
				<th>Prix</th>
				<th>TVA</th>
			</tr>
		</thead>
		<tbody>
			<?php if(count($set) == 0) : ?>
				<tr><td colspan="8" class="danger text-danger text-center">Aucune catégorie...</td></tr>
			<?php else : foreach ($set as $category) : ?>
				<tr>
					<td><?= $category['id'] ?></td>
					<td><img height="50" class="thumbnail" src="<?= $this->assetUrl('img/custom').'/'.$category['view'] ?>" alt=""></td>
					<td><?= $category['category'] ?></td>
					<td><?= $category['category_reference'] ?></td>
					<td><?= $category['name'] ?></td>
					<td><?= $category['description'] ?></td>
					<td><?= $category['price'] ?></td>
					<td><?= $category['price'] ?></td>
					<td><a href="<?= $this->url('admin_delete_category') ?>" class="deleteCategory" data-id="<?= $category['id'] ?>">Supprimer</a></td>
				</tr>
			<?php endforeach; endif; ?>
		</tbody>
	</table>

	<?= $this->insert('inc/_navigation', ['navigationUrl' => $this->url('admin_categories'), 'page' => $page, 'total' => $total, 'limit' => $limit]) ?>

<?php $this->stop('main_content') ?>

<?php $this->start('script') ?>
	<script>
        $(function(){

			ajax_delete('a.deleteCategory', 'Effacer cet catégorie');

        });
	</script>
<?php $this->stop('script') ?>
