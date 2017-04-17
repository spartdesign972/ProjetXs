<?php $this->layout('layout', ['title' => 'Laissez un message'])?>
<?php $this->start('main_content')?>


<div class="container">

	<h1 class="text-center">Contacter nous</h1>
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
						<div class="alert alert-success" style="display: none" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Merci de nous contacter, nous vous répondrons au plus vite !</div>

						<!-- Button -->
						<div class="form-group">
							<label class="col-md-4 control-label"></label>
							<div class="col-md-12 text-center">
								<button type="submit" class="btn btn-warning" >Envoyer <span class="glyphicon glyphicon-send"></span></button>
							</div>
						</div>

					</fieldset>
				</form>

	<div class="row well">
        <div class="col-xs-12 col-sm-4">
          <h2>Adresse :</h2><hr>
          <p><?=getApp()->getconfig('site_title'); ?><br>
          <?=getApp()->getconfig('site_street'); ?> <br>
          <?=getApp()->getconfig('site_city'); ?><br>
          <?=getApp()->getconfig('site_zipcode'); ?>, <?=getApp()->getconfig('site_country'); ?> <br>
          <?=getApp()->getconfig('site_email'); ?> <br>
          <?=getApp()->getconfig('site_phone'); ?></p>
        </div>
        <div class="col-xs-12 col-sm-8">
					<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1488.4749549381231!2d-61.03413626157436!3d14.62034632497685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1483448707514" frameborder="0" style="border:0"></iframe>
        </div>
</div>
<?php $this->stop('main_content')?>
<?php $this->start('footer')?>
<?php $this->insert('inc/_footer') ?>
<?php $this->stop('footer')?>
<?php $this->start('script')?>
<script src="<?=$this->assetUrl('js/ajaxInsert.js')?>" type="text/javascript"></script>
<?php $this->stop('script')?>
