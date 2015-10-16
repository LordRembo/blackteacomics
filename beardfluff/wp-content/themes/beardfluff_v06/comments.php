<section id="comments">
<?php
	if ( post_password_required() ) {
		/** If a password must be entered to view comments */
	} elseif ( have_comments() ) {
?>
	<h1><?php comments_number(); ?></h1>
	
	<?php if ( get_comment_pages_count() > 1 ) { ?>
	<nav class="paginated below"><?php paginate_comments_links(); ?></nav>
	<?php
		}
		
		wp_list_comments( array( 'walker' => new archimedes_Walker_Comment() ) ); /* see functions.php archimedes_Walker_Comment */
		
		if ( get_comment_pages_count() > 1 ) {
	?>
	<nav class="paginated below"><?php paginate_comments_links(); ?></nav>
<?php
		}
	} elseif ( comments_open() ) {
		/** If comments are open but none have been posted */
	} else {
		/** If comments are closed */
	}
	
	$comments_args = array(
        // change the title of comments form  
        'title_reply'=>'<h1>Leave a comment</h1>',
        // change the title of comments form when replying to a comment
        'title_reply_to'=>'<h1>Leave a Reply to  %s</h1>',
        'cancel_reply_link'=>'~ Cancel ~',
        // remove "Text or HTML to be displayed after the set of comment fields"
        'comment_notes_after' => ''
	);

comment_form($comments_args);
?>
</section><!-- #comments -->