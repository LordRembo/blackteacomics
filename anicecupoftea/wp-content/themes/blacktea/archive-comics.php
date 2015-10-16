<?php
/*
Archive for custom post comics:
- list by collection (img, title, descr) + link to first post + collection archive
- sublist nested taxonomy (eg chapters) and link to first post & archive of those as well
- grid or cols: all posts by date (grid or cols per month, blocks per year)
- 
*/
?>

<?php get_header(); ?>

    <div class="main">

        <div class="container">

             <header class="page-header">
                <h1 class="page-title">Comics Archive</h1>
            </header>

            <div class="row group">

                <div class="col col-sm-12">

                    <div class="content">

                        <div class="archive">
                           
                            <nav class="archive">
                                <ul>
                                    <li><a href="#dates">View by date</a></li>
                                    <li><a href="#collections">View by collection</a></li>
                                </ul>
                            </nav>

                            <section class="archive archive-date" id="dates">

                                <h2 class="archive-title">By date</h2>

                                <?php $r = new WP_Query(
                                    array(
                                        'post_type' => array( 'comics' ),
                                       'posts_per_page' => -1,
                                        'order' => 'DESC',
                                        'orderby' => 'date',
                                        'post_status' => 'publish',
                                        'ignore_sticky_posts' => true,
                                        'no_found_rows' => true /*suppress found row count*/
                                    )
                                );

                                $posts = $r->posts;

                                if ($r->have_posts()) {

                                    $year = '';
                                    $month = '';
                                    $prev_month = '';
                                    $prev_year = '';

                                /*echo '<div class="row row-year empty">';
                                echo '<h3>yaar leeg</h3>';
                                echo '<div class="col col-month empty">';
                                echo '<h4>lege maand 1</h4>';
                                echo '<ul>';*/

                                for ($i = 0; $i <= count($posts); $i++) {

                                    $post = $posts[$i];

                                    if ($post->ID) {

                                    $year = get_the_date('Y');
                                    $month = get_the_date('F');

                                    // year
                                    
                                    if($year !== $prev_year) { ?>
                                        
                                        <?php if($prev_year !== '') { ?>
                                        </ul>
                                        </div>
                                        </div>
                                        <?php } ?>

                                        <h3><?php echo $year; ?></h3>
                                        <div class="table-row row-year">

                                        <div class="table-col col-month empty">
                                        <ul>
                                    <?php }

                                    // month

                                    if($month !== $prev_month) { ?>
                                        </ul>
                                        </div>

                                        <div class="table-col col-month">
                                        <h4><?php echo $month;?></h4>
                                        <ul>
                                    <?php } ?>

                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('m/j/y') ?></time>: <?php echo $post->post_title; ?>
                                        </a>
                                    </li>

                                    <?php

                                        $prev_year = $year;
                                        $prev_month = $month;

                                    }
                                }

                                

                                echo '</ul>';
                                echo '</div>';
                                echo '</div>';

                                // Reset the global $the_post as this query will have stomped on it
                                wp_reset_postdata();
                                } ?>
                            </section>

                            <section class="archive archive-collections" id="collections">

                                <h2>By collection</h2>

                                <div class="row group">

                                <?php
                                    // get the terms related to post
                                    $args = array(
                                        'hierarchical' => true,
                                        'orderby' => 'name', //'parent',
                                        'order' => 'ASC',
                                        'parent' => 0,
                                        'hide_empty' => true
                                    );

                                    /*
                                    'show_option_all' => 'Show All Collections',
                                    'taxonomy' => 'collections',
                                    'name' => 'collections',
                                    'orderby' => 'name',
                                    'selected' => ( isset( $wp_query->query['collections'] ) ? $wp_query->query['collections'] : '' ),
                                    'hierarchical' => true,
                                    'depth' => 3,
                                    'show_count' => false,
                                    'hide_empty' => false
                                    */

                                    $terms = get_terms('collections', $args);

                                    if ( !empty( $terms ) ) {

                                        foreach ( $terms as $key => $term ) { ?>
                                            <article class="col col-sm-6 collection-post">
                                                <div class="inner">
                                                    <?php $link = esc_url( get_term_link( $term ) ); ?>

                                                    <?php $r = new WP_Query( array(
                                                       'posts_per_page' => 1,
                                                       'no_found_rows' => true, /*suppress found row count*/
                                                       'post_status' => 'publish',
                                                       'post_type' => 'comics',
                                                       'ignore_sticky_posts' => true,
                                                       'order' => 'ASC',
                                                       'orderby' => 'date',
                                                       'tax_query' => array(
                                                            array(
                                                                    'taxonomy' => 'collections','field' => 'slug', 'terms' => $term->slug
                                                                ) 
                                                            )
                                                       )
                                                    );
                                                    
                                                    if ($r->have_posts()) :
                                                    while ( $r->have_posts() ) : $r->the_post(); ?>

                                                        <?php $posts = get_posts(array(
                                                          'showposts' => -1,
                                                          'post_type' => 'comics',
                                                          'orderby' => 'date',
                                                            'order' => 'ASC',
                                                          'tax_query' => array(
                                                            array(
                                                              'taxonomy' => 'collections',
                                                              //'include_children' => true
                                                              'field' => 'id',
                                                              'terms' => $term->term_id // Where term_id of Term 1 is "1".
                                                            )
                                                          )
                                                        )); 

                                                        $firstLink = get_post_permalink( $posts[0]->ID );
                                                        $lastLink = get_post_permalink( end($posts)->ID );
                                                        $length = count($posts);
                                                        ?>

                                                        
                                                    <div class="visual">
                                                        <a href="<?php echo $link ?>"><?php the_post_thumbnail( array(300, 300) ); // medium, large, full, array(100,100) ?></a>
                                                    </div>

                                                    <div class="entry">

                                                        <h2><a href="<?php echo $link ?>"><?php echo $term->name; ?></a></h2>
                                                        
                                                        <div class="description">
                                                            <p><?php echo $term->description; ?></p>

                                                            <div class="actions group">
                                                                <a class="btn btn-primary btn-sm" href="<?php echo $firstLink; ?>">First post</a>
                                                                <?php if ($length > 1) { ?>
                                                                <a class="btn btn-primary btn-sm" href="<?php echo $lastLink; ?>">Latest post</a>
                                                                <?php } ?>
                                                             </div>
                                                        </div>

                                                    </div>

                                                    <?php $loterms = get_terms("collections", array("orderby" => "date", "order" => 'ASC', "parent" => $term->term_id)); ?>

                                                    <?php if($loterms) : ?>
                                                        <ul class="chapters">
                                                            <?php foreach($loterms as $key => $loterm) : ?>

                                                                <?php $posts = get_posts(array(
                                                                  'showposts' => -1,
                                                                  'post_type' => 'comics',
                                                                  'orderby' => 'date',
                                                                    'order' => 'ASC',
                                                                  'tax_query' => array(
                                                                    array(
                                                                      'taxonomy' => 'collections',
                                                                      //'include_children' => true
                                                                      'field' => 'id',
                                                                      'terms' => $loterm->term_id // Where term_id of Term 1 is "1".
                                                                    )
                                                                  )
                                                                )); 

                                                                $firstLink = get_post_permalink( $posts[0]->ID );
                                                                $lastLink = get_post_permalink( end($posts)->ID );
                                                                $length = count($posts);
                                                                ?>

                                                                <li class="chapter">
                                                                    <?php $lolink = esc_url( get_term_link( $loterm ) ); ?>
                                                                    <h3 class="chapter-name"><?php echo $loterm->name; ?></h3>
                                                                    <?php/*<a href="<?php echo $lolink ?>"><?php echo $loterm->name; ?></a>*/ ?>
                                                                    <span class="link">Begins with <a href="<?php echo $firstLink; ?>">“<?php print_r($posts[0]->post_title) ?>”</a></span>
                                                                     <?php/*
                                                                    <div class="actions group">
                                                                        <a class="btn btn-primary btn-sm" href="<?php echo $firstLink; ?>">First post</a>
                                                                        <?php if ($length > 1) { ?>
                                                                        <a class="btn btn-primary btn-sm" href="<?php echo $lastLink; ?>">Last post</a>
                                                                        <?php } ?>
                                                                     </div>*/?>
                                                                </li>


                                                            <?php endforeach; ?>
                                                        </ul>
                                                    <?php endif; ?>

                                                    <?php endwhile; ?>

                                                    <?php
                                                    // Reset the global $the_post as this query will have stomped on it
                                                    wp_reset_postdata();
                                                    endif; ?>

                                                </div>
                                            </article>

                                        <?php }
                                    }
                                ?>

                                </div>
                            </section>

                            <?php /*if ( have_posts() ) : ?>
                            
                            <!-- Start the Loop -->
                            <?php while ( have_posts() ) : the_post(); ?>
                                <!-- Display -->
                                <div>
                                    <span><a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?></a></span>
                                </div>
                            <?php endwhile; ?>
                 
                            <!-- Display page navigation -->
                            <?php global $wp_query;
                            if ( isset( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 1 ) { ?>
                                <nav id="<?php echo $nav_id; ?>">
                                    <div class="nav-previous"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older reviews'); ?></div>
                                    <div class="nav-next"><?php previous_posts_link( 'Newer reviews <span class= "meta-nav">&rarr;</span>' ); ?></div>
                                </nav>
                            <?php };
                            endif;*/ ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    
<?php get_footer(); ?>