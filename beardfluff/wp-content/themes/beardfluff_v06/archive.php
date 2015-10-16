<?php get_header(); the_post(); ?>

<h1 class="pagetitle">Archive</h1>

<div class="content group" role="main">

        <?php if ( is_date() ) { ?>
   		<section class="hfeed">
			<h1>
				<?php if ( is_year() ) $d = get_the_date( 'Y' );
				elseif ( is_month() ) $d = get_the_time( 'F Y' );
				else $d = get_the_time( get_option( 'date_format' ) );
				printf( __( 'Posts from ', 'archimedes' ), $d ); ?>
			</h1>
			
        <?php } elseif ( is_category() ) { ?>
        <section class="hfeed">
        	<hgroup>
        		<h1>Posts filed under category:</h1>
				<h2>&#8220;<?php printf( __( '%s', 'archimedes' ), single_cat_title( '', false ) ); ?>&#8221;</h2>
			</hgroup>
			
        <?php } elseif ( is_tag() ) { ?>
        <section class="hfeed">
        	<hgroup>
        		<h1>Posts tagged with:</h1>
				<h2>&#8220;<?php printf( __( '%s', 'archimedes' ), single_tag_title( '', false ) ); ?>&#8221;</h2>
			</hgroup>
        <?php } elseif ( is_author() ) { ?>
			<?php if ( get_the_author_meta( 'description' ) && !is_paged() ) { //Show author info on the first page only ?>
				<hgroup>
					<h1>Posts by:</h1>
					<h2><?php the_author(); ?></h2>
				</hgroup>
				
            	<article class="intro">	
            		<div id="author-avatar"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'archimedes_author_bio_avatar_size', 60 ) ); ?></div>
            		<?php the_author_meta( 'description' ); ?>

            		<h2><?php printf( __( 'Posts by %s', 'archimedes' ), get_the_author() ); ?></h2>
          	<?php } else { ?>
          			<h1><?php printf( __( 'Posts by %s', 'archimedes' ), get_the_author() ); ?></h1>
         	<?php } ?>
          		</article>
          		
		  		<section class="hfeed">
		  
        <?php } elseif ( is_tax( 'webcomic_collection' ) ) { query_posts( $query_string . '&order=DESC' );  //Show the last page first ?>
        <section class="hfeed">
        	<hgroup>
       			<h1>Webcomics from collection:</h1>
				<h2>&#8220;<?php printf( __( '', 'archimedes' ), get_webcomic_collection_info( 'name' ) ); ?>&#8221;</h2>
				<p><?php get_webcomic_collection_info( 'description' ); ?></p>
				<div class="group actions">
					<nav class="posts">
					   <ul class="group">
						  <li><?php first_webcomic_link('%link', 'Go to first post'); ?></li>
						</ul>
					</nav>
				</div>

				
			</hgroup>
			
        <?php } elseif ( is_tax( 'webcomic_storyline' ) ) { query_posts( $query_string . '&order=ASC' );  //Show the first story page first?>
        <section class="hfeed">
        	<hgroup>
        		<h1>Webcomics in storyline:</h1>
				<h2>&#8220;<?php printf( __( '', 'archimedes' ), get_webcomic_storyline_info( 'name' ) ); ?>&#8221;</h2>
			</hgroup>
			
        <?php } elseif ( is_tax( 'webcomic_character' ) ) { query_posts( $query_string . '&order=ASC' ); //Show the characters first appearance first ?>
        	<?php if ( !is_paged() ) { //Show character info on the first page only ?>
        		<hgroup>
        			<h1>Posts for character:</h1>
					<h2>&#8220;<?php webcomic_character_info( 'name' ); ?>&#8221;</h2>
				</hgroup>
				
				<article id="post-<?php the_id(); ?>" <?php post_class('intro'); ?>>
					<div class="entry-content rte group">
						<p><span class="character-avatar"><?php webcomic_character_info( 'thumb-full' ); ?></span>
						<?php webcomic_character_info( 'description' ); ?></p>
					</div>
					<!-- <nav><?php //previous_webcomic_character_link( '%link', '&laquo; %name' ); next_webcomic_character_link( '%link', '%name &raquo;' ); ?></nav> -->
				</article>
				
				<section class="hfeed">
					<h1>Appearances</h1>
        	<?php } else { ?>
        		<section class="hfeed">
          			<hgroup>
          				<h1>Appearances by </h1>
          				<h2></h2> &#8220;<?php printf( __( '%s', 'archimedes' ), webcomic_character_info( 'name' ) ); ?>&#8221;</h2>
          			</hgroup>
        <?php } ?>
		  
        <?php } else { ?>
			<section class="hfeed">
				<h1><?php _e( 'Archives', 'archimedes' ); ?></h1>
			
        <?php } ?>
        
        <?php rewind_posts(); ?>
		
		<?php while ( have_posts() ) : the_post();  { ?>

			<article id="comic-<?php the_id(); ?>" <?php post_class( 'comic' ); ?>>
				<header>
					<h1><a href="<?php the_permalink(); ?>" title="Permanent link to <?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
					<time datetime="<?php the_time('Y-m-d') ?>" pubdate> <?php the_time('F j, Y') ?></time>
				</header>
				
				<div class="entry-content group">
					<?php the_webcomic_object('medium','self'); ?>
				  	<?php the_excerpt(); ?>
				</div><!-- //entry-content -->

			</article><!-- //post-->
        
        <?php } endwhile; ?>
				
		<?php if (show_posts_nav()) : ?>
		<nav class="posts">
		   <ul class="group">
			  <li class="prev"><?php previous_posts_link('&laquo; Previous page') ?></li>
			  <li class="next"><?php next_posts_link('Next page &raquo;') ?></li>
		   </ul>
		</nav>
		<?php endif; ?>

	</section><!-- //hfeed -->

</div><!-- //content -->

<aside class="primary" role="complementary">
	<?php get_sidebar('primary'); ?>
</aside>

<?php get_footer(); ?>
