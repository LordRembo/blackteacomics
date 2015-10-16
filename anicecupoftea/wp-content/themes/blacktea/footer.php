		<footer class="primary" role="contentinfo">
			<div class="container">
				<a class="to-top" href="#top" title="Return to top">Return to top</a>

				<ul>
					<li>&copy; 2015 - <?php echo date( 'Y' ); ?> Rembrand Le Compte</li>
					
					<li>Made by <a href="http://rembo.me" title="Designed and built by Rembo">Rembo.me</a></li>
					
					<li>Powered by <a href="http://wordpress.org">WordPress</a></li>

					<li class="cc">
						<span class="hide">This work is licensed under a</span> <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0"><span class="hide">Creative Commons Attribution-Noncommercial 3.0 License.</span>
						<img alt="Creative Commons License" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a>
					</li>
				<ul>
			</div><!-- //container -->
		</footer>

	</div>

	<?php wp_footer(); ?>

	<?php wp_enqueue_script('jquery'); ?>

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/ui.js"></script>
		
</body>

</html>