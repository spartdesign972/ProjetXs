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
		<header>

			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-6">
				  		<img src="./assets/img/logo.png" alt="logo">
				  	</div>
				  	<div class="col-xs-12 col-sm-6">
				  		<div class="col-xs-6 text-right">
				  			<a href="#" title="user"><i class="fa fa-user-circle-o fa-4x" 
				  			aria-hidden="true"></i><br><h4>Connection</h4></a>
				  		</div>
				  		<div class="col-xs-6 text-left">
				  			<a href="#" title="user"><i class="fa fa-shopping-cart fa-4x" aria-hidden="true"></i><br><h4>0 article(s)</h4></a>
				  		</div>
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
						<a class="navbar-brand" href="#">Title</a>
					</div>
			
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav">
							<li class="active"><a href="#">Link</a></li>
							<li><a href="#">Link</a></li>
						</ul>
						<!-- <ul class="nav navbar-nav navbar-right">
							<li><a href="#">Link</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#">Action</a></li>
									<li><a href="#">Another action</a></li>
									<li><a href="#">Something else here</a></li>
									<li><a href="#">Separated link</a></li>
								</ul>
							</li>
						</ul> -->
					</div><!-- /.navbar-collapse -->
				</div>
			</nav>
			<?= $this->section('header') ?>
		</header>

		<main class="container-fluid">
				<?= $this->section('main_content') ?>
		</main>

		<footer>
			<?= $this->section('footer') ?>
		</footer>

	<script type="text/javascript" src="<?= $this->assetUrl('js/jquery.min.js') ?>"></script>

	<script type="text/javascript" src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>

	<?= $this->section('script') ?>

</body>
</html>