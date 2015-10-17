<!doctype html>  
<!--[if lt IE 7 ]> <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie6 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 7 ]>    <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie7 lte9 lte8 lte7"> <![endif]-->
<!--[if IE 8 ]>    <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie8 lte9 lte8"> <![endif]-->
<!--[if IE 9 ]>    <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js ie9 lte9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html itemscope itemtype="http://schema.org/Article" <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>
		   <?php
		      if (function_exists('is_tag') && is_tag()) {
		         single_tag_title("Tag Archive for &quot;"); echo '&quot; - '; }
		      elseif (is_archive()) {
		         wp_title(''); echo ' Archive - '; }
		      elseif (is_search()) {
		         echo 'Search for &quot;'.wp_specialchars($s).'&quot; - '; }
		      elseif (!(is_404()) && (is_single()) || (is_page())) {
		         wp_title(''); echo ' - '; }
		      elseif (is_404()) {
		         echo 'Not Found - '; }
		      if (is_home()) {
		         bloginfo('name'); echo ' - '; bloginfo('description'); }
		      else {
		          bloginfo('name'); }
		      if ($paged>1) {
		         echo ' - page '. $paged; }
		   ?>
	</title>
  	<meta name="description" content="<?php bloginfo( 'meta_description' ); ?>">
	<meta name="author" content="Rembrand Le Compte">

	<meta property="og:title" content="<?php wp_title(''); ?>" />
	<meta property="og:type" content="comic" />	
    <meta property="og:image" content="<?php bloginfo('template_directory'); ?>/img/logo.png" />
    <?php $actual_link = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"; ?>
	<meta property="og:url" content="<?php echo $actual_link; ?>" />
	<meta property="og:site_name" content="<?php bloginfo('name') ?>"/>

	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700,700italic,400italic' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/style.css" type="text/css" media="screen" />

	<?php wp_head(); ?>

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-66767502-1', 'auto');
		ga('send', 'pageview');
	</script>
	
</head>

<body <?php body_class(); ?>>

	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=131702516933005";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	<nav class="primary">
		<?php wp_nav_menu( array( 'theme_location' => 'header-menu' ) ); ?>
	</nav>

	<header class="primary">
		<div class="container">
			<a class="logo" href="<?php echo get_option('home'); ?>/"><img src="<?php bloginfo('template_directory'); ?>/img/logo.png" /></a>
			<h1><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<div class="description"><?php bloginfo('description'); ?></div>
		</div>
	</header>

