<?php get_header(); ?>

	<div class="main">

        <div class="container">

            <header class="page-header">
                <h1 class="page-title"><?php the_title(); ?></h1>
            </header>

            <div class="row group">

                <div class="col col-sm-9 pull-right">

                    <div class="row group">

                        <div class="col col-sm-8">

                            <div class="content">

								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
										
								<div class="post" id="post-<?php the_ID(); ?>">

									<?php //include (TEMPLATEPATH . '/inc/meta.php' ); ?>

									<div class="entry rte group">

										<?php the_content(); ?>

										<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

									</div>

									<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

								</div>
								
								<?php //comments_template(); ?>

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
