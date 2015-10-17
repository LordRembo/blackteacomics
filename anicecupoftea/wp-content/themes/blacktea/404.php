<?php get_header(); ?>

	<div class="main">

        <div class="container">

            <header class="page-header">
                <h1 class="page-title">Page not found</h1>
            </header>

            <div class="row group">

                <div class="col col-sm-9 pull-right">

                    <div class="row group">

                        <div class="col col-sm-8">

                            <div class="content">
										
								<div class="post">

									<div class="entry rte group">

										<p></p>

										<h3>You seem to have been led the wrong way. <br />
											Let's get you back home, you might find what you are looking for there:</h3>

										<a href="<?php echo get_option('home'); ?>/" class="btn btn-secondary">Home</a>
									</div>

									<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>

								</div>
								
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
