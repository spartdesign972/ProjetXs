 <?php 
//hérite du fichier layout.php à la racine de app/Views/
$this->layout('layout', ['title' => 'Voici vos Articles']); ?>


<?php 
//début du bloc main_content
$this->start('main_content'); ?>

<div class="container-fluid">

<h1></h1>
<!-- En-Tête de Présentation -->

<div class="contact col-xs-12">

<h1 class="list">Les Articles</h1>
	
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
					<td class="list"><?=$viewOrder['date_create']; ?></td>
					<td class="list"><?='Commande N°: ' .$viewOrder['id']; ?></td>
					<td class="list"><?=$viewOrder['id']; ?></td>
					<!-- <td class="list"><img style="width: 350px" src="../uploads/<?=$viewOrder['picture']; ?>"></td> -->
					
					<td>
						<a href="<?= $this->url('article_viewArticle',["id" => $viewOrder['id']]) ?>"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span>
							Visualiser cet article</button>
						</a>
					</td>
					
					<td>
						<a href="admin/modif_recipe.php?id=<?=$viewOrder['id']; ?>">
						<button type="button" class="btn btn-info btn-sm">
							<span class="glyphicon glyphicon-edit"></span> Modifier
						</button>
					</a>
				</td>
				
				<td>
					<a href="admin/delete_recipe.php?id=<?=$viewOrder['id']; ?>"><button type="button" class="btn btn-info btn-sm">
						<span class="glyphicon glyphicon-remove"></span>Remove</button>
				</a>
			</td>
		
		</tr>
	


</tbody>
	<?php endforeach; ?>
</table>

</div>

</div>

<?php 
//fin du bloc
$this->stop('main_content'); 
?>