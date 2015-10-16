<?php
/*
Template Name: Page
*/
?>

<?php get_header();  the_post(); ?>

<h1 class="pagetitle"><?php the_title(); ?></h1>

<div class="content group" role="main">
	
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>	  
			<div class="entry-content rte">
			<?php
			  the_content();
			?>
			</div><!-- //entry-content -->
			
			<?php
			  wp_link_pages( array( 'before' => '<nav class="paged">' . __( 'Pages:', 'archimedes' ), 'after' => '</nav>' ) );
			  edit_post_link( __( 'Edit', 'archimedes' ), '<span class="edit-link">', '</span>' );
			?>
			
	</article><!-- //post<?php the_ID(); ?> -->

</div><!-- //content -->

<aside class="primary" role="complementary">
	<?php get_sidebar('primary'); ?>
</aside>
          
<?php get_footer(); ?>