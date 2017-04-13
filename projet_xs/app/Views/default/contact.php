<?php $this->layout('layout', ['title' => 'Laissez un message'])?>
<?php $this->start('main_content')?>
	
<div class="container">

	<div id="result"></div>

	<h1>Contacter nous</h1>
	<form class="jumbotron form-horizontal" action="<?=$this->url('default_contact') ?>" method="post" id="subscribe_form">
					<fieldset>
						<!-- last_name-->
						<div class="form-group">
							<label class="col-md-3 control-label" >Nom</label>
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input name="lastname" placeholder="Nom" class="form-control"  type="text">
								</div>
							</div>
						</div>

						<!-- subject-->

						<div class="form-group">
							<label class="col-md-3 control-label">Objet du message</label>
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="subject" placeholder="subject" class="form-control"  type="text">
								</div>
							</div>
						</div>

						<!-- email-->

						<div class="form-group">
							<label class="col-md-3 control-label">E-Mail</label>
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
									<input name="email" placeholder="E-Mail Address" class="form-control"  type="text">
								</div>
							</div>
						</div>

						<!-- Text area -->

						<div class="form-group">
							<label class="col-md-3 control-label">Message</label>
							<div class="col-md-6 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
									<textarea class="form-control"  rows="5" name="comment" placeholder="Votre message"></textarea>
								</div>
							</div>
						</div>

						<!-- Success message -->
						<div class="alert alert-success" style="display: none" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Merci de nous contacter, nous vous répondrons au plus vite !!!</div>

						<!-- Button -->
						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-4">
								<button type="submit" class="btn btn-warning" >Envoyer <span class="glyphicon glyphicon-send"></span></button>
							</div>
						</div>

					</fieldset>
				</form>

</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>

<?php $this->stop('footer')?>
<?php $this->start('script')?>
<script src="<?=$this->assetUrl('js/ajaxInsert.js')?>" type="text/javascript"></script>
<?php $this->stop('script')?>
