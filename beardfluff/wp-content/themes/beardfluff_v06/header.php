<!doctype html>  
<!--[if lt IE 7 ]> <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7 ]>    <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8 ]>    <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9 ]>    <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie9 lte9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
  
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="description" content="<?php bloginfo( 'meta_description' ); ?>">
	<meta name="author" content="Rembrand Le Compte">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- OpenGraph 
    <meta name="og:url" content="" >
    <meta name="og:site_name" content="" >
    <meta name="og:image" content="" >
	<meta name="og:title" content="" >
	<meta name="og:description" content="" >-->
		
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<link rel="icon" href="<?php bloginfo( 'icon_url' ); ?>" />
	<link rel="shortcut icon" href="/favicon.ico" />
 	<link rel="apple-touch-icon" href="/apple-touch-icon.png" />

	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Lobster|Droid+Serif:400italic' rel='stylesheet' type='text/css'>
	
	<link rel="stylesheet" charset="utf-8" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="stylesheet" media="screen and (min-width: 320px)" charset="utf-8" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/320.css" />
	<link rel="stylesheet" media="screen and (min-width: 480px)" charset="utf-8" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/480.css" />
	<link rel="stylesheet" media="screen and (min-width: 600px)" charset="utf-8" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/600.css" />
	<link rel="stylesheet" media="screen and (min-width: 800px)" charset="utf-8" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/800.css" />
	<link rel="stylesheet" media="screen and (min-width: 1024px)" charset="utf-8" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/1024.css" />
	<link rel="stylesheet" media="screen and (min-width: 1200px)" charset="utf-8" href="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/css/1200.css" />

	<script src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/libs/2.5.3/modernizr.custom.js"></script>
	<script type="text/javascript">
		/* <![CDATA[ 
		(function() {
    		var s = document.createElement('script');
    		var t = document.getElementsByTagName('script')[0];

    		s.type = 'text/javascript';
    		s.async = true;
    		s.src = 'http://api.flattr.com/js/0.6/load.js?mode=auto';

    		t.parentNode.insertBefore(s, t);
 		})();*/
		/* ]]> */
	</script>
	    	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<!-- Start of Analytics Code -->
	<script type="text/javascript">
		var _gaq = _gaq || [];
		//_gaq.push(['_setVar', 'exclude_me']); //adds cookie to exclude own ip, don't forget to remove after testing
		_gaq.push(['_setAccount', 'UA-40672265-1']);
		_gaq.push(['_trackPageview']);
	    setTimeout('_gaq.push([\'_trackEvent\', \'NoBounce\', \'Over 30 seconds\'])',30000);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			//ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	
	<header class="primary" role="banner">
    	<div class="wrap">
			<div class="container">
				<a id="logo" href="<?php echo home_url( '/' ); ?>" rel="home">
					<img class="full" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/img/logo-full.png" alt="logo Beardfluff" />
					<img class="icon" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/img/logo-icon.png" alt="small logo Beardfluff" />
				</a>
	
				<hgroup>
					<h1><?php bloginfo( 'name' ); ?></h1>
					<!-- <h2 class="tagline">Comics by <span>Rembrand Le Compte</span></h2> -->
					<h3>Comics by Rembrand</h3>
				</hgroup>
							
				<nav class="primary group">
					<?php wp_nav_menu( array( 'container' => false, 'theme_location' => 'navbar' ) ); ?>
				</nav>
				
				<?php // if on a single comic or home =========================================
				//if ( ( 'webcomic_post' == get_post_type() && is_single() ) || is_home() ) {  ?>
					<nav class="secundary group">
			
						<h1>Collections:</h1>
						
						<?php
						// http://wordpress.org/support/topic/list-posts-by-taxonomy-tag
						
						$post_type = 'webcomic_post';
						$tax = 'webcomic_collection';
						$tax_terms = get_terms($tax,'hide_empty=0');
						?>
						
						<ul class="group">
							<?php
							//list the taxonomy
							foreach ($tax_terms as $tax_term) {
								$wpq = array ('taxonomy'=>$tax,'term'=>$tax_term->slug);
								$query = new WP_Query ($wpq);
								$article_count = $query->post_count;
								echo "<li class=\"webcomic_collection-".$tax_term->slug."\"><a href=\"/beardfluff/collection/".$tax_term->slug."\">".$tax_term->name."</a></li>";
								
							} ?>
						
						</ul>
					</nav>
				<?php //} 
				// =========================================================================== ?>
			</div>
			
			<?php get_sidebar('primary-ads'); ?>

    	</div><!-- //wrap-->
	</header><!-- #header -->

	<div id="main">
		<div class="wrap group">