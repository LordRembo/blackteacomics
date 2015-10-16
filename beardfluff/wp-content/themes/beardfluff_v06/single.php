<?php get_header();  the_post(); ?>

	<?php if ( class_exists( 'webcomic' ) && is_singular( 'webcomic_post' ) ) {
	//single webcomic ======================================================================================================= ?>		
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
				<input class="field" name="shorturl" type="text" value="<?php $surl = getBitUrl(get_permalink($post->ID)); echo $surl ?>" />
				
			</div>
			
					<!-- <span class="flattr">
						<a class="FlattrButton" href="<?php echo urlencode(get_permalink($post->ID)); ?>" title="<?php the_title(); ?>" lang="en" data-flattr-uid="Rembrand" data-flattr-tags="comics, webcomics, beardfluff" data-flattr-category="images" rev="flattr;button:compact;">
  						Beardfluff | Comics by Rembrand Le Compte
						</a>
					</span> -->
		</footer>
		  
	</article><!-- //comic -->
		
	 <nav class="comics group">
	 		<?php first_webcomic_link(); previous_webcomic_link(); next_webcomic_link(); last_webcomic_link(); ?>
	 </nav>
		  
</section><!-- // comic part -->

	<?php //get_sidebar('secundary-ads'); ?>

<div class="wrap-main group">
	
<div class="content group" role="main">
	
	<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
					
		<div itemprop="description" class="entry-content rte group">
				<?php
					the_content();
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
		
	<?php  comments_template( '', true ); ?>
	  
</div><!-- //cols: non-comic part -->

<aside class="primary" role="complementary">
	<?php get_sidebar('primary'); ?>
</aside>
	
<!-- //single webcomic  -->

	<?php } else {
	//single post ======================================================================================================= ?>

	<h1 class="pagetitle">News</h1>
	
	<div class="content group" role="main">
			
			<?php if ( is_attachment() ) { ?>
				<p><a href="<?php echo get_permalink( $post->post_parent ); ?>" title="<?php printf( esc_attr__( 'Return to %s', 'archimedes' ), esc_html( get_the_title( $post->post_parent ), 1 ) ); ?>" rel="gallery">&larr; <?php echo get_the_title( $post->post_parent ); ?></a></p>
          <?php } ?>
			
			
		
			<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>
				<header>
					<h1><?php the_title(); ?> <?php edit_post_link( 'Edit', ' | ', '' ); ?></h1>
					<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>
				</header><!-- //post header -->
				
				<div class="entry-content rte group">
					<?php
						the_content();
					?>
				</div><!-- //entry-content -->
			  
				<?php  if ( is_attachment() ) { ?>
					<nav class="attachment">
						<ul>
							<li><?php previous_image_link( false ); ?></li>
							<li><?php next_image_link( false ); ?></li>
						</ul>
					</nav>
				<?php } ?>
			  
				<footer>
					<div class="shorturl group">
						<h3>Share: </h3>
						<input class="field" name="shorturl" type="text" value="<?php $surl = getBitUrl(get_permalink($post->ID)); echo $surl ?>" />
				
					</div>
					
				<?php
						if ( get_the_category() ) {
							_e( ' <h3>Category:</h3> ', 'archimedes' );
							the_category( ', ' );
							the_tags( __( ' <h3>Tags:</h3> ', 'archimedes' ), ', ' );
						} else
							the_tags( __( ' <h3>Tags</h3> ' ), ', ' );
				?>
					<div class="comments">
						<span class="comments">
							<?php comments_popup_link( '0 comments','1 comment', '% comments', 'comments-link', 'Comments are 
			off for this post'); ?>
						</span>
						
					</div>
				</footer><!-- post footer -->
			</article><!-- //post<?php the_ID(); ?> -->

			<nav class="posts">
				<ul class="group">
					<li class="prev"><?php previous_post_link('%link', '&laquo; Previous post', TRUE); ?></li>
					<li class="next"><?php next_post_link('%link', 'Next post &raquo;', TRUE); ?></li>
				</ul>
			</nav>
			
			<div class="ads ads-secundary">
				<?php get_sidebar('secundary-ads'); ?>
			</div><!-- //ads -->

			<?php  comments_template( '', true ); ?>
	  
	</div><!-- //content -->

	<aside class="primary" role="complementary">
		<?php get_sidebar('primary'); ?>
	</aside>

	</div><!-- //wrap-content -->

    <?php }?>
          
	<?php get_footer(); ?>