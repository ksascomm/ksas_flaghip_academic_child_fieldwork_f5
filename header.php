<!DOCTYPE html>
<html lang="en" class="no-js"> 

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <meta http-equiv="cache-control" content="public">
  <title><?php create_page_title(); ?></title>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" />
  <!-- CSS Files: All pages -->
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/assets/stylesheets/app.css">
  <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri() ?>/style.css">
  <!-- CSS Files: Conditionals -->
  
  <!-- Modernizr and Jquery Script -->
  <script src="<?php echo get_template_directory_uri() ?>/assets/js/vendor/modernizr-min.js"></script>
  <?php wp_enqueue_script('jquery', true); ?> 
  <?php wp_head(); ?>

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script async src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <?php include_once("parts-analytics.php"); ?>
</head>
<?php $theme_option = flagship_sub_get_global_options(); $color_scheme = $theme_option['flagship_sub_color_scheme']; global $blog_id; $site_id = 'site-' . $blog_id; ?>
<body <?php body_class($color_scheme . ' ' . $site_id); ?>>	
		<header>
	   <div id="mobile-nav">
		<div class="row">
			<div class="small-12 large-4 columns centered blue_bg">
			<div class="mobile-logo centered"><a href="<?php echo network_site_url(); ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo.png" alt="jhu logo"></a></div>
			<h2 class="white" align="center"><?php echo get_bloginfo( 'title' ); ?></h2>
			</div>
		</div>
		<div class="row hide-for-print">
				<div id="search-bar" class="small-12 columns">
					
						<div class="small-6 columns">
						<?php $theme_option = flagship_sub_get_global_options();
								$collection_name = $theme_option['flagship_sub_search_collection'];
						?>

						<form method="GET" action="<?php echo site_url('/search'); ?>">
							<input type="submit" class="icon-search" value="&#xe004;" />
							<input type="text" name="q" placeholder="Search this site" />
							<input type="hidden" name="site" value="<?php echo $collection_name; ?>" />
						</form>
						</div>
							<?php wp_nav_menu( array(
								'theme_location' => 'search_bar',
								'menu_class' => '',
								'fallback_cb' => 'foundation_page_menu',
								'container' => 'div',
								'container_id' => 'search_links',
								'container_class' => 'small-6 columns links inline',
								'depth' => 1,
								'items_wrap' => '%3$s', )); ?>
					
				</div>	<!-- End #search-bar	 -->
			</div>
		</div>
		
	   <div id="desktop-nav">
		<div class="row hide-for-print">
			<div id="search-bar" class="small-12 medium-5 medium-offset-7 columns">
				<div class="row">
					<div class="small-6 columns">
					<?php $theme_option = flagship_sub_get_global_options(); 
							$collection_name = $theme_option['flagship_sub_search_collection'];
					?>

					<form method="GET" action="<?php echo site_url('/search'); ?>">
						<input type="submit" class="icon-search" value="&#xe004;" />
						<input type="text" name="q" placeholder="Search this site" />
						<input type="hidden" name="site" value="<?php echo $collection_name; ?>" />
					</form>
					</div>
						<?php wp_nav_menu( array( 
							'theme_location' => 'search_bar', 
							'menu_class' => '', 
							'fallback_cb' => 'foundation_page_menu', 
							'container' => 'div',
							'container_id' => 'search_links', 
							'container_class' => 'small-6 columns links inline mobile-two',
							'depth' => 1,
							'items_wrap' => '%3$s', )); ?> 
				</div>	
			</div>	<!-- End #search-bar	 -->
		</div>
		<div class="row" id="department">
			<div class="medium-12 columns" id="logo_nav">
				<div class="medium-3 columns">
					<li class="logo"><a href="<?php echo network_home_url(); ?>" title="Krieger School of Arts & Sciences"><img src="<?php echo get_template_directory_uri() ?>/assets/images/ksas-logo.png" alt="jhu logo"></a></li>
				</div>
				<div class="medium-9 columns">
					<h1><a class="white" href="<?php echo site_url(); ?>"><span class="small"><?php echo get_bloginfo ( 'description' ); ?></span><?php echo get_bloginfo( 'title' ); ?></a></h1>
				</div>						
			</div>
		</div>
		<div class="row hide-for-print">
			<?php wp_nav_menu( array( 
				'theme_location' => 'main_nav', 
				'menu_class' => 'nav-bar', 
				'container' => 'nav',
				'container_id' => 'main_nav', 
				'container_class' => 'small-12 columns',
				'fallback_cb' => 'foundation_page_menu',
				'walker' => new foundation_navigation(),
				'depth' => 2  )); ?> 
		</div>
		</div>
		</header>