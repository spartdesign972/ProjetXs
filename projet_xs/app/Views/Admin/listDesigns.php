<?php $this->layout('layoutAdmin', ['title' => 'login'])?>
<?php $this->start('main_content')?>
<div id="content" class="container">
				<section class="row">
					<!-- En-Tête de Présentation -->
					<div class="contact col-xs-12">
						<h1 class="list">Les recettes</h1>
						<br>
						<table class="well table">
							<thead>
								<tr>
									<th class="list">Nom</th>
									<th class="list">Recette</th>
								</tr>
							</thead>designsFinal

							<tbody>
								<?php foreach ($designs as $designsFinal): ?>
								<tr>
									<td class="list"><?=$designsFinal['rcp_title'];?></td>

									<td>
										<a href="view_recipe.php?id=<?=$designsFinal['rcp_id'];?>"><button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-eye-open"></span>
											Visualiser cette recette</button>
										</a>
									</td>
									<td>
										<a href="modif_recipe.php?id=<?=$designsFinal['rcp_id'];?>"><button type="button" class="btn btn-info btn-sm">
											<span class="glyphicon glyphicon-edit"></span> Modifier
											</button>
										</a>
									</td>
									<td>
										<a href="delete_recipe.php?id=<?=$designsFinal['rcp_id'];?>"><button type="button" class="btn btn-info btn-sm">
											<span class="glyphicon glyphicon-remove"></span> Remove
											</button>
										</a>
									</td>
								</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</section>
			</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>

<?php $this->stop('footer')?>
