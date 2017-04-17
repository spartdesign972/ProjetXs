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
					<th>Details</th>
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
<?php $this->insert('inc/_footer') ?>
<?php $this->stop('footer');?>
