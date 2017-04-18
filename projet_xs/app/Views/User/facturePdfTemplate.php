<?php
$panierCommande = (array)$panierCommande;

?><!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Facture</title>
	<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/bootstrap.min.css') ?> ">
	<link rel="stylesheet" type="text/css" href=" <?=$this->assetUrl('css/pdf.css') ?> ">
</head>
<body>
	<h1>FACTURE</h1>
	<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Shirt Factory Xs</h2><h3 class="pull-right">Commande N°: <?=$view_order['id']  ?></h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Adressé à:</strong><br>
    					<?=$user['lastname'].' '.$user['firstname'] ?><br>
    					<?=$user['street'] ?><br>
    					<?=$user['zipcode'].' '.$user['city'] ?><br>
    					<?=$user['country'] ?><br>
    					<?=$user['email'] ?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>De:</strong><br>
    					<p><?=getApp()->getconfig('site_title'); ?><br>
          		<?=getApp()->getconfig('site_street'); ?> <br>
		          <?=getApp()->getconfig('site_city'); ?><br>
		          <?=getApp()->getconfig('site_zipcode'); ?>, <?=getApp()->getconfig('site_country'); ?> <br>
		          <?=getApp()->getconfig('site_email'); ?> <br>
		          <?=getApp()->getconfig('site_phone'); ?></p>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    		
    			<div class="col-xs-12  text-right">
    				<address>
    					<strong>Date de facturation:</strong><br>
    					<?php $date = date_create($view_order['date_create']); ?>
    					<?=date_format($date,'d  M  Y'); ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Resumé de la commande</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                    <tr>
        							<td><strong>REF</strong></td>
        							<td class="text-center"><strong>Prix</strong></td>
        							<td class="text-center"><strong>Quantité</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                    </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
    							<?php $total = 0 ?>
    							<?php foreach ($panierCommande['libelleProduit'] as $key => $value): ?>
    							<tr>
    								<td><?=$panierCommande['ref'][$key];?></td>
    								<td class="text-center"><?=$panierCommande['price'][$key];?></td>
    								<td class="text-center"><?=$panierCommande['qty'][$key];?></td>
    								<td class="text-right"><?=$panierCommande['price'][$key] * $panierCommande['qty'][$key].'€';?></td>
    							</tr>
    							<?php $total += $panierCommande['price'][$key] * $panierCommande['qty'][$key]; ?>
    						<?php endforeach; ?>
    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>total</strong></td>
    								<td class="thick-line text-right"><?=$total.'€';  ?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
</body>
</html>





