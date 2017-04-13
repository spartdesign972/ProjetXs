<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?= $this->e($title) ?></title>
		<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/bootstrap.min.css') ?> ">
		<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
		<link href="https://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps|Gochi+Hand|PT+Sans" rel="stylesheet">
		<link rel="stylesheet" href="../bower_components/wow/css/libs/animate.css">

		<script type="text/javascript" src="<?= $this->assetUrl('js/jquery.min.js') ?>"></script>
		<script src="../bower_components/wow/dist/wow.min.js"></script>
			<!-- Bootstrap SweetAlert CSS -->
	    <link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('../../bower_components/bootstrap-sweetalert/dist/sweetalert.css') ?>">
		<?php if(!empty($w_user)): ?>
			<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/styleconnecter.css') ?>">
		<?php endif; ?>
		

		<script>
			new WOW().init();
		</script>
		<?= $this->section('link') ?>
	</head>
	<body>

	<?php if(!empty($w_user)): ?>
			<nav class="navbar navbar-inverse navbar-fixed-top navbar-xs" role="navigation">
					<div class="container-fluide">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-user-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<!-- <a class="navbar-brand" href="#">Title</a> -->
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-user-collapse">
							<ul class="nav-user navbar-nav">

								<li><a href="<?=$this->url('default_modifInfos')?>">Mes informations</a></li>
								<li><a href="<?=$this->url('default_password')?>">Mon mot de passe</a></li>
								<li><a href="<?=$this->url('user_listDesigns')?>">Mes Réalisations</a></li>
								<li><a href="<?=$this->url('users_listOrders')?>">Mes Commandes</a></li>
								
								<?php if($w_user['role'] == 'admin'): ?>
									<li><a href="<?=$this->url('admin_showadmin')?>">Admin</a></li>	
								<?php endif; ?>
							</ul>
							<ul class="nav-user navbar-nav navbar-right">

										<li><span class="text-muted"><?php echo 'Bienvenue '.$w_user['lastname'].'<br>' ?></span></li>

									<li><a href=" <?= $this->url('logout') ?> ">Vous Déconnecter</a></li>

									<li class="spacer">--</li>
								</li>
								<li>
									<a href="<?= $this->url('cart_creationPanier') ?>"><i class="fa fa-shopping-cart panier fa-2x" aria-hidden="true"></i><h4>0 article(s)</h4></a>
									
								</li>
							</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>
		<?php endif; ?>

		<!-- <div id="page"> -->
		<header>
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-xs-12">
							<img src="<?=$this->assetUrl('./img/logo2.png') ?>" class="img-responsive logo" alt="logo">
						</div>

					</div>
				</div>
			</div>
			<div class="row">
				<!-- <div class="container"> -->
				<nav class="navbar navbar-default menu" role="navigation" data-spy="affix" data-offset-top="150">
					<div class="container">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<!-- <a class="navbar-brand" href="#">Title</a> -->
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav">

								<li><a href="<?=$this->url('default_home')?>">Accueil</a></li>
								<li><a href="<?=$this->url('default_custom')?>">Personnalisation</a></li>
								<li><a href="<?=$this->url('default_showalldesignmembre')?>">Inspiration</a></li>
								<li><a href="#">Nous Situer</a></li>
								<li><a href="<?=$this->url('default_contact')?>">Nous Contacter</a></li>
							</ul>
							<?php if(empty($w_user)): ?>
							<ul class="nav navbar-nav navbar-right">
								<li><i class="fa fa-user-circle-o" aria-hidden="true"></i></li>
								<li><a href="<?=$this->url('login')?>">Connexion / Inscription</a>
								</li>
							</ul>
							<?php endif; ?>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>
					<!-- </div> -->
				</div>
				<?= $this->section('header') ?>
			</header>
			<div class="clearfix"></div>
			<main class="container-fluid">
			<?= $this->section('main_content') ?>
			</main>
			<!-- </div> -->
			<div id="footer">
				<?= $this->section('footer') ?>
			</div>

			<script type="text/javascript" src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
			<!-- Bootstrap SweetAlert JS -->
		  <script src="<?= $this->assetUrl('../../bower_components/bootstrap-sweetalert/dist/sweetalert.min.js') ?>"></script>
			<script type="text/javascript">
				$(document).ready(function() {

					var footerHeight = $('#footer').height();
					positionfooter();

					function positionfooter(){
						var docHeight = $(window).height();
						var footerTop = $('#footer').position().top + footerHeight;
						if (footerTop < docHeight) {
							$('#footer').css('margin-top', 10+ (docHeight - footerTop) + 'px');
						}
					}
					$(window).resize(positionfooter);

					// Chargement du bouton Like
					var $likeButton = $('.my-like');
					var resHTML = '';
					$.ajax({
						method: 'post',
						url: '<?= $this->url('i_like') ?>',
						data: {user_id: $likeButton.data('user'), prod_id: $likeButton.data('id'), action: 'search'},
						dataType: 'json',
						success: function(result){
							if(result.status == 'success') {
								$likeButton.html('<a href="<?= $this->url('i_like') ?>" class="btn btn-default" role="button"> <i class="fa fa-heart like-'+result.my_like+'" aria-hidden="true"></i></a>');
							}
						}
					});

					// Click sur bouton Like
					$likeButton.click(function(e){
						e.preventDefault();

						$.ajax({
							method: 'post',
							url: $likeButton.find('a').attr('href'),
							data: {user_id: $likeButton.data('user'), prod_id: $likeButton.data('id')},
							dataType: 'json',
							success: function(result){
								if(result.status == 'success') {
									$likeButton.html('<a href="<?= $this->url('i_like') ?>" class="btn btn-default" role="button"> <i class="fa fa-heart like-'+result.my_like+'" aria-hidden="true"></i></a>');
									$likeButton.prev('.nb-like').html(result.likes_count + ' <i class="fa fa-heart" aria-hidden="true"></i>')
								}
							}
						});
					});
				});
			</script>
			<?= $this->section('script') ?>
		</body>
	</html>
