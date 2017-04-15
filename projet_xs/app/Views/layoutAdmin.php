<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title><?= $this->e($title) ?></title>
		<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/bootstrap.min.css') ?> ">
		<link rel="stylesheet" href="<?= $this->assetUrl('css/styleAdmin.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('css/font-awesome.min.css') ?>">
		<link href="https://fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps|Gochi+Hand|PT+Sans" rel="stylesheet">
		<!-- Bootstrap SweetAlert CSS -->
	    <link rel="stylesheet" type="text/css" href="<?= $this->assetUrl('../../bower_components/bootstrap-sweetalert/dist/sweetalert.css') ?>">

		<?= $this->section('link') ?>
	</head>
	<body>
		<!-- <div id="wrap"> -->

				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="container-fluid">
						<!-- Brand and toggle get grouped for better mobile display -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="#">ProjectXs-Admin</a>
							<a id="menu-toggle" href="#" class="btn btn-menu btn-lg">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                  </a>
						</div>
						<!-- Collect the nav links, forms, and other content for toggling -->
						<div class="collapse navbar-collapse navbar-ex1-collapse">
							<ul class="nav navbar-nav">
								<li>
									<a id="menu-toggle" href="#" class="btn btn-menu btn-lg">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
								</li>
							</ul>
								<ul class="nav navbar-nav navbar-right">
								<li><a href="<?=$this->url('admin_logout')?>"><i class="fa fa-user-circle-o user" aria-hidden="true"></i> Déconnexion</a></li>
								</li>
							</ul>
							</div><!-- /.navbar-collapse -->
						</div>
					</nav>
					<?= $this->section('header') ?>

				<div id="wrapper" data-spy="scroll" data-target="#spy" class="">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <nav id="spy">
                <ul class="sidebar-nav nav">
                    <li class="sidebar-brand">
                        <a href="<?=$this->url('default_home') ?>"><i class="fa fa-home fa-2x"></i> Acceuil</a>
                    </li>
                    <li>
                        <a href="<?= $this->url('admin_users') ?>" data-scroll>
                            <span>Utilisateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->url('admin_products') ?>" data-scroll>
                            <span>Produits</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->url('admin_categories') ?>" data-scroll>
                            <span>Catégories</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $this->url('admin_orders') ?>" data-scroll>
                            <span>Commandes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Page content -->
        <div id="page-content-wrapper">
            <?= $this->section('main_content') ?>
        </div>

    </div>
			<footer>
				<?= $this->section('footer') ?>
			</footer>
			<script type="text/javascript" src="<?= $this->assetUrl('js/jquery.min.js') ?>"></script>
			<script type="text/javascript" src="<?= $this->assetUrl('js/bootstrap.min.js') ?>"></script>
			<!-- Bootstrap SweetAlert JS -->
		    <script src="<?= $this->assetUrl('../../bower_components/bootstrap-sweetalert/dist/sweetalert.min.js') ?>"></script>

			<?= $this->section('script') ?>
			<script type="text/javascript">
				$(document).ready(function() {
        
                
	/*Menu-toggle*/
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    });
			</script>
		</body>
	</html>