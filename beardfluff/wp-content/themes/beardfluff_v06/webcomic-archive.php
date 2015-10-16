<?php
/**
 * Template Name: Webcomic Archive
 */
?>

<?php get_header(); ?>

<h1 class="pagetitle"><?php the_title(); ?></h1>

<div class="content group" role="main">

	<div class="hfeed">
	
		
		<article id="post-<?php the_id(); ?>" <?php post_class(); ?>>	  
			<?php
			  edit_post_link( __( 'Edit'), '<div class="button">', '</div>' );
			?>
			<!-- 
			<section id="archive-search" class="search">
				<h1>Search the comics</h1>
				
				<div id="cse" style="width: 100%;">Loading</div>
				<script src="//www.google.com/jsapi" type="text/javascript"></script>
				<script type="text/javascript"> 
				  google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
				  google.setOnLoadCallback(function() {
				    var customSearchControl = new google.search.CustomSearchControl('006759437216104904064:243cigcm3me');
				    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
				    customSearchControl.draw('cse');
				  }, true);
				</script>
			</section>
			-->
			
			<section id="archive-dropdown" class="dropdown">
				<h1>Browse by month</h1>
				<?php
					webcomic_archive( 'last_only=1&group=month&format=dropdown&order=DESC&show_count=true' ); //drowpdown
				?>
			</section> 

			<section id="archive-thumbs" class="archive-thumbs">
				<h1>Browse thumbnails</h1>
				<?php
					// http://wordpress.org/support/topic/list-posts-by-taxonomy-tag
					
					$post_type = 'webcomic_post';
					$tax = 'webcomic_collection';
					$arg = array('hide_empty' => 0, 'orderby' => 'id', 'order' => 'DESC');
					//$tax_terms = get_terms($tax,'hide_empty=0');
					$tax_terms = get_terms($tax, $arg);
					?>
					
					<nav class="archive">
						<ul class="group">
						<?php
						//list the taxonomy
						foreach ($tax_terms as $tax_term) {
							$wpq = array ('taxonomy'=>$tax,'term'=>$tax_term->slug);
							$query = new WP_Query ($wpq);
							$article_count = $query->post_count;
							echo "<li><a href=\"#".$tax_term->slug."\">".$tax_term->name."</a></li>";
							
						} ?>
					
						</ul>
					</nav>
					
					<?php
					
					//list everything
					if ($tax_terms) {
					  foreach ($tax_terms  as $tax_term) {
						$args=array(
						  'post_type' => $post_type,
						  "$tax" => $tax_term->slug,
						  'post_status' => 'publish',
						  'posts_per_page' => -1,
						  'caller_get_posts'=> 1
						);
					
						$my_query = null;
						$my_query = new WP_Query($args);
						if( $my_query->have_posts() ) {
						
						  echo '<div class="thumbs">'."\n";
						
						  echo "<h2 id=\"".$tax_term->slug."\"> $tax_term->name </h2>"."\n";
						  						  
						  echo '<div class="group">';
						  
						  while ($my_query->have_posts()) : $my_query->the_post(); ?>
							
							<a href="<?php the_permalink() ?>" rel="bookmark" title="Read ‘<?php the_title_attribute(); ?>’">
								<?php the_webcomic_object('small'); ?>
								<span class="title"><?php the_title_attribute(); ?></span>
							</a>
								 
							<?php
						  endwhile;
						  
						  echo '</div>' . "\n";
						  
						  echo '<a class="top" href="#top">Back to top</a>';

						  echo '</div>';
						}
						wp_reset_query();
					  }
					}
					
					?>
			</section> 

			
			<!-- <section id="archive-collections" class="archive-collections cols group">
				<h1>Browse by collection</h1>
				
					<?php
					// http://wordpress.org/support/topic/list-posts-by-taxonomy-tag
					
					$post_type = 'webcomic_post';
					$tax = 'webcomic_collection';
					$tax_terms = get_terms($tax,'hide_empty=0');
					?>
					
					<nav class="archive">
						<ul class="group">
						<?php
						//list the taxonomy
						foreach ($tax_terms as $tax_term) {
							$wpq = array ('taxonomy'=>$tax,'term'=>$tax_term->slug, 'orderby'=>'date');
							$query = new WP_Query ($wpq);
							$article_count = $query->post_count;
							echo "<li><a href=\"#".$tax_term->slug."\">".$tax_term->name."</a></li>";
							
						} ?>
					
						</ul>
					</nav>
					
					<div class="group">
					<?php
					
					//list everything
					if ($tax_terms) {
					  foreach ($tax_terms  as $tax_term) {
						$args=array(
						  'post_type' => $post_type,
						  "$tax" => $tax_term->slug,
						  'post_status' => 'publish',
						  'posts_per_page' => -1,
						  'caller_get_posts'=> 1
						);
					
						$my_query = null;
						$my_query = new WP_Query($args);
						if( $my_query->have_posts() ) {
						
						  echo '<div class="collection">'."\n";
						
						  echo "<h2 id=\"".$tax_term->slug."\"> $tax_term->name </h2>"."\n";
						  						  
						  echo '<table cellpadding="0" cellspacing="0" border="0">';
						  
						  while ($my_query->have_posts()) : $my_query->the_post(); ?>

							<tr>
								<td class="date"><?php the_time('d M Y'); ?></td>
								<td class="title">
									<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
										<?php the_title(); ?>
										<span class="thumb"><?php the_webcomic_object('small'); ?></span>
									</a>
								</td>
							</tr> 
				
							<?php
						  endwhile;
						  
						  echo '</table>' . "\n";
						  
						  echo '<a class="top" href="#top">Back to top</a>';

						  echo '</div>';
						}
						wp_reset_query();
					  }
					}
					
					?>
					</div>

			</section> -->
		
		
			
		</article><!-- //post<?php the_ID(); ?> -->
		
		<?php 
			wp_link_pages( array( 'before' => '<nav class="paged">' . __( 'Pages:', 'archimedes' ), 'after' => '</nav>' ) );
		?>
	
	</div><!-- //hfeed -->

</div><!-- //content -->

<aside class="primary" role="complementary">
	<?php get_sidebar('primary-archive'); ?>
</aside>

<?php get_footer(); ?>