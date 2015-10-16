<?php
/*
Archive template: 
- tag: list all the comics
- terms for taxonomy
- other
*/
?>
 
<?php get_header(); ?>
 
    <div class="main">

        <div class="container">

            <div class="row group">

                <div class="col col-sm-9">

                    <div class="content">

                        <div class="archive archive-comics">

							<?php if (have_posts()) : ?>

					 			<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

					 			<header class="page-header">
					 			<?php /* If this is a category archive */ if (is_category()) { ?>
									<h1 class="page-title">Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>

								<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
									<h1 class="page-title">Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>

								<?php /* If this is a comic post archive */ } elseif( get_post_type() == 'comics' ) { ?>
									<h1 class="page-title">Archive for chapter &#8216;<?php post_type_archive_title(); ?>&#8217;</h1>
									<?php print_r(wp_title()) ?>

								<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
									<h1 class="page-title">Archive for <?php the_time('F jS, Y'); ?></h1>

								<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
									<h1 class="page-title">Archive for <?php the_time('F, Y'); ?></h1>

								<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
									<h1 class="page-title" class="pagetitle">Archive for <?php the_time('Y'); ?></h1>

								<?php /* If this is an author archive */ } elseif (is_author()) { ?>
									<h1 class="page-title" class="pagetitle">Author Archive</h1>

								<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
									<h1 class="page-title" class="pagetitle">Blog Archives</h1>
								
								<?php } ?>
								</header>

								<?php //include (TEMPLATEPATH . '/inc/nav.php' ); ?>


								<?php if( is_tag() ) { ?>

								<?php while (have_posts()) : the_post(); ?>

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

                                    </div>

									<div class="tags"><?php the_tags( '<strong>Tags:</strong>', ', ', ''); ?></div>

								</article>

								<?php endwhile; ?>

								<?php } elseif (get_post_type() == 'comics') { ?>



								<?php } else { ?>

								<?php while (have_posts()) : the_post(); ?>
								
									<div <?php post_class() ?>>
									
										<h2 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
									
										<?php include (TEMPLATEPATH . '/inc/meta.php' ); ?>

										<div class="entry">
											<?php the_content(); ?>
										</div>

									</div>

								<?php endwhile; ?>

								<?php //include (TEMPLATEPATH . '/inc/nav.php' ); ?>

								<?php } ?>
								
							<?php else : ?>

								<h2>Nothing found</h2>

							<?php endif; ?>

                      	</div>

                    </div>
                </div>

                <div class="col col-sm-3">
                    <?php get_sidebar('secondary'); ?>
                </div>

            </div>
        </div>
    </div>
<?php get_footer(); ?>
