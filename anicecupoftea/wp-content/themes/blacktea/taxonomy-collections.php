<?php
/*
Archive template for collections taxonomy
- list all the comics per nested tax (if any)
*/
?>
 
<?php get_header(); ?>
 
    <div class="main">

        <div class="container">

        	<?php $termObject = $wp_query->get_queried_object(); ?>

			<?php

            	$args = array(
            			"orderby" => "date",
            			"order" => 'DESC',
            			"parent" => $termObject->term_id
            		);

            	$terms = get_terms("collections", $args);
        	?>

        	<header class="page-header">
                <h1 class="page-title"><span>Collection:</span> <?php echo($termObject->name); ?></h1>
            </header>

            <div class="row group">

                <div class="col col-sm-12 pull-right">

                    <div class="row group">

                        <div class="col col-sm-9">

                            <div class="content">

                                <div class="archive archive-chapters">
									

                                    <?php
                                    	//foreach($terms as $key => $term) :
                                    	if (count($terms) > 0) { 
	                                    	for ($i = 0; $i <= count($terms); $i++) {

	                                    		$term = $terms[$i];

												if ( $term->parent !== 0 ) { ?>
													<section class="chapter">

														<h2 class="chapter-title"><?php echo $term->name ?></h2>

														<?php $r = new WP_Query( array(
	                                                       'posts_per_page' => -1,
	                                                       'no_found_rows' => true, /*suppress found row count*/
	                                                       'post_status' => 'publish',
	                                                       'post_type' => 'comics',
	                                                       'ignore_sticky_posts' => true,
	                                                       'order' => 'DESC',
	                                                       'orderby' => 'date',
	                                                       'paged' => false, // TODO: add paging
	                                                       //'posts_per_page' => 10,
	                                                       'tax_query' => array(
	                                                            array(
	                                                                    'taxonomy' => 'collections',
	                                                                    'field' => 'slug',
	                                                                    'terms' => $term->slug
	                                                                ) 
	                                                            )
	                                                       )
	                                                    );
														
														if ($r->have_posts()) :
														//while ( $r->have_posts() ) : $r->the_post(); ?>

	                                                	<?php 
	                                                	for ($j = 0; $j <= count($terms); $j++) {

	                                                		$posts = $r->posts;
	                                                		$post = $posts[$j];

	                                                	if ($post->ID) {

	                                                		//foreach($r->posts as $key => $post) :  ?>

														<article class="archive-post">
															<?php //print_r($post) ?>
															
															<div class="entry">
	                                                            
	                                                            <h3><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h3>
																<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>

	                                                            <div class="visual">
		                                                            <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( "thumbnail" ); // medium, large, full, array(100,100) ?></a>
		                                                        </div>

		                                                        <div class="description">
		                                                            <p><a href="<?php the_permalink(); ?>"><?php echo trimString($post->post_content); ?></a></p>
		                                                        </div>

																<div class="tags"><?php the_tags( '<strong>Tags:</strong>', ', ', ''); ?></div>
		                                                        
	                                                        </div>

														</article>
														<?php
														}
														} 
														//endforeach; ?>

	                                                	<?php //endwhile;

														// Reset the global $the_post as this query will have stomped on it
														wp_reset_postdata();
														endif; ?>

													</section>
												<?php }
											//endforeach;
											}
										} else { ?>

											<?php while (have_posts()) : the_post(); ?>
			
											<article class="archive-post">

												<div class="entry">

													<h3><a href="<?php the_permalink(); ?>"><?php echo $post->post_title; ?></a></h3>
													<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>
                                                     
                                                    <div class="visual">
                                                        <a href="<?php the_permalink() ?>"><?php the_post_thumbnail( "thumbnail" ); // medium, large, full, array(100,100) ?></a>
                                                    </div>

                                                    <div class="description">
                                                        <p><a href="<?php the_permalink(); ?>"><?php echo trimString($post->post_content); ?></a></p>
                                                    </div>
                                                </div>

												<div class="tags"><?php the_tags( '<strong>Tags:</strong>', ', ', ''); ?></div>

											</article>

										<?php	endwhile; 
										} ?>

                              	</div>

                            </div>
                        </div>

                        <div class="col col-sm-3">
                            <?php get_sidebar('secondary'); ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php get_footer(); ?>