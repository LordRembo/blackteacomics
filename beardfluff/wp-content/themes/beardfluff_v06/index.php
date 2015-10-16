<?php get_header();  the_post(); ?>

<?php if ( is_home() ) { 
//home.php ======================================================================================================= ?>

<?php
	//query_posts('cat=-174&p=' . get_option( 'sticky_posts' )); //exclude category 'comics', display 1 post 
	//while(have_posts()) : the_post(); //count the posts

	$sticky = get_option( 'sticky_posts' );
	$args = array(
		'cat' => -174,
		'posts_per_page' => 1,
		'post__in'  => $sticky,
		'ignore_sticky_posts' => 1
	);
	query_posts( $args );
	if ( $sticky[0] ) {
?> 
<div class="newsflash">	
	<a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute( 'echo=0' ); ?>" rel="bookmark">
		<span>“<?php the_title(); ?>”</span>&nbsp;|&nbsp;<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>

	</a>
</div><!-- //newsflash -->
<?php  } //endwhile; ?>

<?php if ( class_exists( 'webcomic' ) ) { $q = new WP_Query( 'post_type=webcomic_post&posts_per_page=1' ); while( $q->have_posts() ) { $q->the_post(); ?>

<section class="group group-comic">
 	
	<article class="comic comic-<?php the_id(); ?>">

 		<header>
 			<div class="collections">
 				<?php the_webcomic_post_collections(array('after' => ':','separator' => ', ' )); ?>
 			</div>

			<h1 itemprop="name">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a> <?php edit_post_link( 'Edit', ' | ', '' ); ?>
				<span class="comments"><?php comments_popup_link('0', '1', '%', '', off); ?></span>
			</h1>
			<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>
		</header><!-- //comic header -->
		
	 	<nav class="arrows">
	 		<?php previous_webcomic_link(); next_webcomic_link(); ?>
	 	</nav>	 	
	 		
		<?php the_webcomic_object(); ?>
     
		<footer> 
			<div class="shorturl group">
				<h3>Share: </h3>
				<?php $surl = getBitUrl(get_permalink($post->ID)); ?>
				<input class="field" name="shorturl" type="text" value="<?php echo $surl ?>" />
				
			</div>
				<!-- <span class="flattr">
					<a class="FlattrButton" href="<?php echo urlencode(get_permalink($post->ID)); ?>" title="<?php the_title(); ?>" lang="en" data-flattr-uid="Rembrand" data-flattr-tags="comics, webcomics, beardfluff" data-flattr-category="images" rev="flattr;button:compact;">
  						Beardfluff | Comics by Rembrand Le Compte
					</a> 
				</span> -->
		</footer>
      
	</article><!-- // comic -->

 	<nav class="comics group">
		<?php
			first_webcomic_link();
			previous_webcomic_link();

			next_webcomic_link();
			last_webcomic_link();
		?>
	</nav>
  
</section><!-- //comic part -->

<div class="wrap-main group">

	<?php get_sidebar('secundary-ads'); ?>

<div class="content group" role="main">

	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
				
		<div itemprop="description" class="entry-content rte group">
			<?php
				the_content();
				//the_excerpt();
			?>
		</div><!-- //entry-content -->
		  
		<footer>
			<?php
				the_webcomic_post_collections( array( 'before' => __( ' <h3>Collection:</h3> ', 'archimedes' ), 'separator' => ', ', 'after' => __('<br />') ) );
				the_webcomic_post_storylines( array( 'before' => __( ' <h3>Storyline:</h3> ', 'archimedes' ), 'separator' => ', ', 'after' => __('<br />') ) );
				the_webcomic_post_characters( array( 'before' => __( ' <h3>Featuring:</h3> ', 'archimedes' ), 'separator' => ', ', 'after' => __('<br />') ) );
				
				if ( get_the_category() ) {
					
						_e( '<h3>Category:</h3> ', 'archimedes' );
						the_category( ', ' );
						_e('<br />');
					
						the_tags( __( '<h3>Tags:</h3> ', 'archimedes' ), ', ' );
						_e('<br />');
					
				} else
					
						the_tags( __( '<h3>Tags: </h3> ' ), ', ' );
						_e('<br />');
			?>
								
		  </footer><!-- post footer -->
				
	</article><!-- //post<?php the_ID(); ?> -->
	
	<?php //get_sidebar('tertiary-ads'); ?>

	<section class="news">
		
		<h1 class="blog-title">News</h1>

        	<?php
				query_posts('cat=-174&posts_per_page=10'); //exclude category 'comics', display 10 posts 
				if (have_posts()) : $countposts = 0; while(have_posts()) : the_post(); $countposts++; //count the posts
			?> 

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					
				  		<h1><a href="<?php the_permalink(); ?>" title="Permanent Link to <?php the_title_attribute( 'echo=0' ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				  
						<?php if($countposts == 1) { //if first post, do this ?>
				  
	  						<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>

							<div class="entry-content">
								<?php the_excerpt('Read the rest of this entry &raquo;'); ?>
								
							</div><!-- //entry-content -->
						<?php } //end the first post stuff ?>
				</article><!-- #post-<?php the_ID(); ?> -->

			  <?php endwhile; endif; ?>
	
			  <nav class="group">
					<a class="more" href="/category/news">more news &raquo;</a>
			  </nav>
		  
	</section><!-- //news -->

</div><!-- //content -->
	
<aside class="primary" role="complementary">
	<?php get_sidebar('primary'); ?>
</aside>

</div><!-- //wrap-main -->

<!-- //home -->

<?php } } ?> 
    	
<?php } elseif ( is_404() ) {
//404.php ======================================================================================================= ?>

<!-- //404  -->

<?php }
// end ifs ======================================================================================================?>

<?php get_footer(); ?>