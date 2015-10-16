		</div><!-- wrap -->
	</div><!-- #main -->
      
      <footer class="primary" role="contentinfo">
          <div class="wrap">
            <p>
              <a href="#banner" title="Return to top">Return to top</a> &copy; 2007 - <?php echo date( 'Y' ); ?> Rembrand Le Compte&nbsp;&nbsp;|&nbsp;&nbsp;
              <?php
                bloginfo( 'name' );
              ?> <?php
                printf( __( 'is powered by <a href="%s">WordPress</a> with <a href="%s">Webcomic</a>&nbsp;&nbsp;|&nbsp;&nbsp;
              Subscribe: <a href="%s">RSS</a> - <a href="%s">Comments</a>', 'archimedes' ), 'http://wordpress.org/', 'http://webcomicms.net/', 'http://feeds.feedburner.com/Beardfluff', get_bloginfo( 'comments_rss2_url' ) );
              ?>
               &nbsp;&nbsp;|&nbsp;&nbsp;Design: <a href="http://rembo.me" title="Design by Rembo">Rembo.me</a><br />
           This work is licensed under a Creative Commons Attribution-Noncommercial 3.0 License.
           <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0"><img style="vertical-align:top" alt="Creative Commons License" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a>
         		</p>
		</div><!-- //wrap -->
	</footer><!-- #footer -->
      
	<?php wp_footer(); ?>
  
    <!-- Twitter @anywhere
    <script src="//platform.twitter.com/anywhere.js?id=m4uB1e5yyOoN9taLaYzwxg&amp;v=1"></script> --> 

    <!-- Start of Custom Code -->
    <script data-main="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/init.js" src="<?php bloginfo( 'stylesheet_directory' ); ?>/assets/js/require-jquery.min.js"></script>
    <!-- End custom code -->

	<!-- Start of Woopra Code  -->
	<script type="text/javascript">
	function woopraReady(tracker) {
	    tracker.setDomain('beardfluff.com');
	    tracker.setIdleTimeout(300000);
	    tracker.track();
	    return false;
	}
	(function() {
	    var wsc = document.createElement('script');
	    wsc.src = document.location.protocol+'//static.woopra.com/js/woopra.js';
	    wsc.type = 'text/javascript';
	    wsc.async = true;
	    var ssc = document.getElementsByTagName('script')[0];
	    ssc.parentNode.insertBefore(wsc, ssc);
	})();
	</script>
	<!-- End of Woopra Code -->

  </body>
</html>