<aside class="primary">

    <h1 class="hide">First sidebar</h1>

    <section class="widget widget--collections">
        <h3>Collections</h3>
        <ul class="list-items has-icon">
        <?php 
            $args = array(
                'orderby'           => 'name', 
                'order'             => 'DESC',
                'hide_empty'        => true
            );
            $terms = get_terms( 'collections', $args );

            foreach($terms as $key => $term) : 
                if ( $term->parent == 0 ) {
                    echo '<li class="has-icon"><a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a></li>';
                }
            endforeach;
        ?>
        </ul>
    </section>

    <section class="widget widget--follow">
        <h3>Follow</h3>
        <ul class="list-items has-icon">
            <li class="twitter"><a class="icon" href="http://www.twitter.com/lordrembo">Twitter</a></li>
            <li class="instagram"><a class="icon" href="http://www.instagram.com/rembrand">Instagram</a></li>
            <li class="mail"><a class="icon" href="#">E-mail</a></li>
            <li class="facebook"> <a class="icon" href="https://www.facebook.com/BlackTeaComics">Entries (RSS)</a></li>
            <li class="tumblr"><a class="icon" href="<?php bloginfo('rss2_url'); ?>">Rembo.me</a></li>
            <li class="rss"><a class="icon" href="<?php bloginfo('rss2_url'); ?>">Entries (RSS)</a></li>
        </ul>
    </section>

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?> 
    <?php endif; ?>

</aside>