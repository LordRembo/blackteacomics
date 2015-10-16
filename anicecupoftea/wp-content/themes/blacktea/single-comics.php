<?php get_header(); ?>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section class="comic-visuals">


		<div class="container">
			<header>
				<div class="title-collection">
					Collection:
					<?php 

					$terms = get_the_terms( $post->ID, 'collections' );

					foreach($terms as $key => $term) : 
						if ( $term->parent == 0 ) {
							echo '<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
						}
					endforeach; ?>
				</div>

				<nav class="comics">
					<ul>
						<li class="first"><?php echo getComicLink('first'); ?></li>

				    	<li class="prev"><?php echo previous_post_link('%link', 'Previous'); ?></li>
						<li class="next"><?php echo next_post_link('%link', 'Next'); ?></li>

						<li class="last"><?php echo getComicLink('last'); ?></li>
					</ul>
			    </nav>
			</header>
		</div>
		
		<div class="contents">
		<?php /*$args = array(
		   'post_type' => 'attachment',
		   'numberposts' => -1,
		   'post_status' => null,
		   'post_parent' => $post->ID,
		   'order' => 'DESC',
			'orderby' => 'menu_order DESC'
		);

		$attachments = get_posts( $args );
	    if ( $attachments ) {
	     	echo "<div class=\"post-attachments\">";
	        foreach ( $attachments as $attachment ) {

	        	$class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );

	            echo '<div class="' . $class . ' ">';
	          	echo wp_get_attachment_image( $attachment->ID, 'full' );
	          	echo '</div>';
	           //echo '<p>';
	           //echo apply_filters( 'the_title', $attachment->post_title );
	           //echo '</p>';
	        }
           echo '</div>';
	    } */?>

	    <?php

		if ( has_post_thumbnail()) {
			echo '<div class="comic has-icon">';
		   the_post_thumbnail('full');
		   echo '</div><br />';
		}

		// check if the post has a Post Thumbnail assigned to it.
		//http://codex.wordpress.org/Function_Reference/the_post_thumbnail#Post_Thumbnail_Linking_to_Large_Image_Size
							
		if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('comics', 'post-thumbnail-2')) :
			echo '<div class="comic has-icon">';
			MultiPostThumbnails::the_post_thumbnail('comics', 'post-thumbnail-2', NULL, 'post-thumbnail-2-thumbnail');
			echo '</div><br />';
		endif;

		if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('comics', 'post-thumbnail-3')) :
			echo '<div class="comic has-icon">';
			MultiPostThumbnails::the_post_thumbnail('comics', 'post-thumbnail-3', NULL, 'post-thumbnail-3-thumbnail');
			echo '</div><br />';
		endif;

		if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('comics', 'post-thumbnail-4')) :
			echo '<div class="comic has-icon">';
			MultiPostThumbnails::the_post_thumbnail('comics', 'post-thumbnail-4', NULL, 'post-thumbnail-4-thumbnail');
			echo '</div><br />';
		endif;

		if (class_exists('MultiPostThumbnails') && MultiPostThumbnails::has_post_thumbnail('comics', 'post-thumbnail-5')) :
			echo '<div class="comic has-icon">';
			MultiPostThumbnails::the_post_thumbnail('comics', 'post-thumbnail-5', NULL, 'post-thumbnail-5-thumbnail');
			echo '</div><br />';
		endif; 
		?>
		</div>

		<div class="container">
			<nav class="comics has-icon last">

				<ul>
					<li class="first"><?php echo getComicLink('first'); ?></li>

			    	<li class="prev"><?php echo previous_post_link('%link', 'Previous'); ?></li>

					<li class="next"><?php echo next_post_link('%link', 'Next'); ?></li>

					<li class="last"><?php echo getComicLink('last'); ?></li>
				</ul>
		    </nav>

		    <footer>
		    	<?php get_sidebar('share'); ?>
		    </footer>
		</div>

	</section>

	<?php endwhile; endif; ?>

	<div class="main">

		<div class="container has-icon">

			<div class="row group">

				<div class="col col-sm-9 pull-right">

					<div class="row group">

						<div class="col col-sm-8">
							<div class="content">

								<?php get_sidebar('ads-post'); ?>

								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
								<section <?php post_class('post--comic') ?> id="post-<?php the_ID(); ?>">
									
									<div class="breadcrumb">
										<strong>Collection: </strong>
										<ul>
										<?php 

										$terms = get_the_terms( $post->ID, 'collections' );

										foreach(array_reverse($terms) as $key => $term) : 
											//if ( $term->parent == 0 ) {
												echo '<li><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
											//}
										endforeach; ?>
										</ul>
									</div>
									
									<time class="has-icon" datetime="<?php the_time('Y-m-d') ?>">
										<span class="day"><?php  the_time('M') ?></span>
										<span class="month"><?php  the_time('d') ?></span>
										<span class="year"><?php  the_time('Y') ?></span>
									</time>

									<h1 class="title has-icon"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <?php edit_post_link('Edit',' | ',''); ?></h2>

									<div class="entry has-icon rte group">
								
										<?php //include (TEMPLATEPATH . '/inc/meta.php' ); ?>
										
										<?php the_content(); ?>

										<?php //wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
										
										<div class="tags"><?php the_tags( '<strong>Tags:</strong>', ', ', ''); ?></div>

									</div>
								
								</section>

								<section class="comments">
									<div id="disqus_thread"></div>
									<script type="text/javascript">
									    /* * * CONFIGURATION VARIABLES * * */
									    var disqus_shortname = 'blackteacomics';
									    
									    /* * * DON'T EDIT BELOW THIS LINE * * */
									    (function() {
									        var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
									        dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
									        (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
									    })();
									</script>
									<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
								</section>
										
								<?php endwhile; endif; ?>

							</div>
						</div>

						<div class="col col-sm-4">
							<?php get_sidebar('secondary'); ?>
						</div>
					</div>
				</div>

				<div class="col col-sm-3">
					<?php get_sidebar('primary'); ?>
				</div>

			</div>
		</div>
	</div>
	
<?php get_footer(); ?>