<?php
/*
Template Name: Page
*/
?>

<?php get_header();  the_post(); ?>

<h1 class="pagetitle">Woops!</h1>

<div class="content group" role="main">
	
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>	
		<div class="entry-content rte">
				<p>Looks like something went wrong and we couldn&#8217;t find the page you&#8217;re looking for.<br />
				Terribly sorry about that!</p>
				<p>You could try going back to <a href="http://beardfluff.com">the Homepage</a> or <a href="http://beardfluff.com/archive">check the archives</a>.</p>
			
		</div><!-- //entry-content -->
			
	</article><!-- //post<?php the_ID(); ?> -->
	
</div><!-- //content -->
          
<?php get_footer(); ?>