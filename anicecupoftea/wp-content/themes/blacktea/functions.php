<?php
	
	// Add RSS links to <head> section
	automatic_feed_links();
	
	// Load jQuery
	if ( !is_admin() ) {
	   wp_deregister_script('jquery');
	   wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"), false);
	   wp_enqueue_script('jquery');
	}
	
	// Clean up the <head>
	function removeHeadLinks() {
        remove_action('wp_head', 'rsd_link'); // remove really simple discovery link
        remove_action('wp_head', 'wp_generator'); // remove wordpress version

        remove_action('wp_head', 'feed_links', 2); // remove rss feed links (make sure you add them in yourself if youre using feedblitz or an rss service)
        remove_action('wp_head', 'feed_links_extra', 3); // removes all extra rss feed links

        remove_action('wp_head', 'index_rel_link'); // remove link to index page
        remove_action('wp_head', 'wlwmanifest_link'); // remove wlwmanifest.xml (needed to support windows live writer)

        remove_action('wp_head', 'start_post_rel_link', 10, 0); // remove random post link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // remove parent post link
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // remove the next and previous post links
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );

        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
    }
    add_action('init', 'removeHeadLinks');

    // custom post type: comics
    function create_comic() {
        register_post_type( 'comics',
            array(
                'labels' => array(
                    'name' => 'Comics',
                    'singular_name' => 'Comic',
                    'add_new' => 'Add New',
                    'add_new_item' => 'Add New Comic',
                    'edit' => 'Edit',
                    'edit_item' => 'Edit Comic',
                    'new_item' => 'New Comic',
                    'view' => 'View',
                    'view_item' => 'View Comic',
                    'search_items' => 'Search Comics',
                    'not_found' => 'No Comics found',
                    'not_found_in_trash' => 'No Comics found in Trash',
                    'parent' => 'Parent Comic'
                ),
     
                'public' => true,
                'show_ui' => true,
                'menu_position' => 15,
                'taxonomies' => array('post_tag'),
                'supports' => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes', 'post-formats', 'post_tag' ),
                //'taxonomies' => array( '' ),
                //'menu_icon' => plugins_url( 'images/image.png', __FILE__ ),
                'has_archive' => true,
                'rewrite' => array(
                    'slug' => 'comics',
                    'with_front' => true
                )
            )
        );

        //flush_rewrite_rules();      
    }

    add_action( 'init', 'create_comic' );

    // custom taxonomies
    // (for use with our custom post type "comics")
    function create_my_taxonomies() {
          register_taxonomy('collections', 'comics', array(
                    'hierarchical' => true, 
                    'label' => 'Collections',
                    'labels' => array(
                        'name' => 'Collections',
                        'add_new_item' => 'Add New Collection',
                        'new_item_name' => "New Collection"
                    ),
                    'show_ui' => true,
                    'query_var' => true,
                    'rewrite' => array(
                        'slug' => 'collections',
                        'hierarchical' => true,
                        'with_front' => true
                    )
                )
          );
    }
    add_action('init', 'create_my_taxonomies', 0);

    // filter custom posts by taxonomy
    function comics_filter_list() {
        $screen = get_current_screen();
        global $wp_query;
        if ( $screen->post_type == 'comics' ) {
            wp_dropdown_categories( array(
                'show_option_all' => 'Show All Collections',
                'taxonomy' => 'collections',
                'name' => 'collections',
                'orderby' => 'name',
                'selected' => ( isset( $wp_query->query['collections'] ) ? $wp_query->query['collections'] : '' ),
                'hierarchical' => true,
                'depth' => 3,
                'show_count' => false,
                'hide_empty' => false
            ) );
        }
    }  

    function wpse28145_add_custom_types( $query ) {
        if( is_tag() && $query->is_main_query() ) {

            // this gets all post types:
            //$post_types = get_post_types();

            // alternately, you can add just specific post types using this line instead of the above:
            $post_types = array( 'post', 'comics' );

            $query->set( 'post_type', $post_types );
        }
    }
    add_filter( 'pre_get_posts', 'wpse28145_add_custom_types' );  

    add_action( 'restrict_manage_posts', 'comics_filter_list' );

    function perform_filtering( $query ) {
        $qv = &$query->query_vars;
        if ( ( $qv['collections'] ) && is_numeric( $qv['collections'] ) ) {
            $term = get_term_by( 'id', $qv['collections'], 'collections' );
            $qv['collections'] = $term->slug;
        }
    }

    add_filter( 'parse_query','perform_filtering' );
    
    // get taxonomies terms links
    function custom_taxonomies_terms_links(){
      // get post by post id
      $post = get_post( $post->ID );

      // get post type by post
      $post_type = $post->post_type;

      // get post type taxonomies
      $taxonomies = get_object_taxonomies( $post_type, 'objects' );

      $out = array();
      foreach ( $taxonomies as $taxonomy_slug => $taxonomy ){

        // get the terms related to post
        $terms = get_the_terms( $post->ID, $taxonomy_slug );

        if ( !empty( $terms ) ) {
          /*$out[] = "<ul>";
          foreach ( $terms as $term ) {
            $out[] =
              '  <li><a href="'
            .    get_term_link( $term->slug, $taxonomy_slug ) .'">'
            .    $term->name
            . "</a></li>\n";
          }
          $out[] = "</ul>\n";*/

          $out = "<span>" . end($terms)->name . "</span>";
        }
      }

      //return implode('', $out );
      return $out;
    }

    // register sidebar widgets
    if (function_exists('register_sidebar')) {
    	register_sidebar(array(
    		'name' => 'Sidebar Widgets',
    		'id'   => 'sidebar-widgets',
    		'description'   => 'These are widgets for the sidebar.',
    		'before_widget' => '<div id="%1$s" class="widget %2$s">',
    		'after_widget'  => '</div>',
    		'before_title'  => '<h3>',
    		'after_title'   => '</h3>'
    	));
    }

     function getComicLink($start) {

        if ($start == 'first') $start = true;
        elseif ($start = 'last') $start = false;

        $page = get_posts(
            array(
                'post_type' => 'comics',
                'posts_per_page' => 1,
                'order' => $start ? 'ASC' : 'DESC',
                'update_post_term_cache' => false,
                'update_post_meta_cache' => false
            )
        );

        $permalink = get_post_permalink( $page[0]->ID);
        $link = '<a href=' . $permalink . '>' . $start . '</a>';

        return ( $link );
    } 

    // register menus
    function register_my_menu() {
      register_nav_menu('header-menu',__( 'Header Menu' ));
    }
    add_action( 'init', 'register_my_menu' );  

    // add home button to menu
    function home_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
    }
    add_filter( 'wp_page_menu_args', 'home_page_menu_args' );

    // active class in menu
    function special_nav_class($classes, $item){
         if( in_array('current-menu-item', $classes) ){
                 $classes[] = 'active ';
         }
         return $classes;
    }
    add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);


    function trimString($content) {
        return substr(strip_tags($content),0,200) . '…';
    }

    // register sidebars
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
            'name' => 'Sidebar Widgets',
            'id'   => 'sidebar-primary',
            'description'   => 'These are widgets for the sidebar.',
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        ));
        register_sidebar(array(
            'name' => 'Sidebar Widgets Secondary',
            'id'   => 'sidebar-secondary',
            'description'   => 'These are widgets for the sidebar.',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>'
        ));
    }


    // Add secondary thumbnail (featured image) in posts */

    add_theme_support( 'post-thumbnails' );

    // Define additional "post thumbnails". Relies on MultiPostThumbnails to work
    // http://lifeonlars.com/wordpress/how-to-add-multiple-featured-images-in-wordpress/
    if (class_exists('MultiPostThumbnails')) {

        new MultiPostThumbnails(array(
            'label' => 'Comic Image 2',
            'id' => 'post-thumbnail-2',
            'post_type' => 'comics'
            )
        );

        new MultiPostThumbnails(array(
            'label' => 'Comic Image 3',
            'id' => 'post-thumbnail-3',
            'post_type' => 'comics'
            )
        );

        new MultiPostThumbnails(array(
            'label' => 'Comic Image 4',
            'id' => 'post-thumbnail-4',
            'post_type' => 'comics'
            )
        );

        new MultiPostThumbnails(array(
            'label' => 'Comic Image 5',
            'id' => 'post-thumbnail-5',
            'post_type' => 'comics'
            )
        );

    }

    //add_image_size('post-secondary-image-thumbnail', 250, 150);


    // Add custom post types - cpt1 and cpt2 to main RSS feed.
    function mycustomfeed_cpt_feed( $query ) {
            if ( $query->is_feed() )
                $query->set( 'post_type', array( 'post', 'comics' ) ); 
            return $query;
    }
    add_filter( 'pre_get_posts', 'mycustomfeed_cpt_feed' );


    // override Feed templates
    // https://katz.co/custom-rss-feed-in-wordpress/
    function create_rss2() {
        load_template( TEMPLATEPATH . '/feeds/feed-comics-rss2.php'); // You'll create a your-custom-feed.php file in your theme's directory
    }

    remove_all_actions( 'do_feed_rss2' );
    add_action('do_feed_rss2', 'create_rss2', 10, 1); // Make sure to have 'do_feed_customfeed'

    /*// add featured image to RSS
    function featuredtoRSS($content) {
    global $post;
    if ( has_post_thumbnail( $post->ID ) ){
    $content = '<div>' . get_the_post_thumbnail( $post->ID, 'medium', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
    }
    return $content;
    }
     
    add_filter('the_excerpt_rss', 'featuredtoRSS');
    add_filter('the_content_feed', 'featuredtoRSS');*/

    // remove wp version nummer in RSS
    function killVersion() { return ''; }
    add_filter('the_generator','killVersion');
?>