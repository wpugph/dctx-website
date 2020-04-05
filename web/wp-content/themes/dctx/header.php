<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="description" content="<?php bloginfo('description'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="apple-touch-icon" href="<?php echo ROOT; ?>apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo ROOT; ?>favicon.png">

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?>>
	<!--[if lt IE 8]><p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p><![endif]-->

	<header>
		<div class="header-container">
			<div class="container clearfix">
				<a href="<?php echo get_home_url(); ?>" class="logo" title="<?php bloginfo('name'); ?>"><img src="<?php echo IMAGES; ?>logo.svg" alt="<?php bloginfo('name'); ?>"></a>

				<nav class="nav-main">
					<?php 
						wp_nav_menu(array(
							'theme_location' => 'header',
							'container' => '',
							'container_class' => '',
							'menu_class' => 'clearfix'
						)); 
					?>
				</nav>
			</div>
		</div>
	</header>
	
