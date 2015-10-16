<aside class="secondary">

    <h1 class="hide">Second sidebar</h1>

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets Secondary')) : else : ?>	
    <?php endif; ?>

    <section class="widget widget--patreon">
        <h3>Become a Patron</h3>
        <a class="icon" href="http://www.patreon.com/rembrand" target="_blank">
			Support us on Patreon
		</a>
    </section>

    <section class="widget widget--ads">
	    <h3>Advertisement</h3>
	    <iframe src='http://inkoutbreak.com/exchange/boxy.php?box=2395&box_key=b85758680c14f540b8c3cedf00c31327' scrolling='no'  allowtransparency='1' width='160' height='228' frameborder='0' style='overflow: hidden;'></iframe>
	</section>
</aside>