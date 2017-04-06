<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?= $this->e($title) ?></title>
		<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/bootstrap.min.css') ?> ">
		<link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
		<link href="https://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps|Gochi+Hand|PT+Sans" rel="stylesheet">
		
		<?= $this->section('link') ?>
	</head>
	<body>
		<!-- <div id="wrap"> -->
			<header>
				<div class="page-header">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 col-sm-6 logo">
								<img src="./assets/img/logo.png" alt="logo">
							</div>
							<div class="col-xs-12 col-sm-6">
							</div>
						</div>
					</div>
				</div>
				
				<nav class="navbar navbar-default" role="navigation" data-spy="affix" data-offset-top="150">
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
								<li><a href="<?=$this->url('default_home')?>">Acceuil</a></li>
								<li><a href="#">Link</a></li>
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="user-brand">
									<div><i class="fa fa-user-circle-o user"
									aria-hidden="true"></i></div>
									<a href="<?=$this->url('login')?>"><h4>Connection</h4></a>
									<a href="<?=$this->url('default_subscribe')?>" title=""><h4 class="second">inscription</h4></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-shopping-cart panier" aria-hidden="true"></i><h4>0 article(s)</h4></a>
								</li>
							</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>
					<?= $this->section('header') ?>
				</header>
				<div class="clearfix"></div>
				<main class="container-fluid">
				<?= $this->section('main_content') ?>
				</main>
			<!-- </div> -->
			<footer>
				<?= $this->section('footer') ?>
			</footer>
			<script type="text/javascript" src="<?= $this->assetUrl('js/jquery.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
			<?= $this->section('script') ?>
		</body>
	</html>