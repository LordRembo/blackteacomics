/*!
 * <Projectname>
 *
 * Copyright 2011, <author>, Marlon bvba <http://www.marlon.be>
 *
 * Date: @DATE
 */

// Require.js allows us to configure shortcut aliases
require.config({
    paths: {}
});

require(['jquery'], function($)
{
    /*
     * Although $(document).ready is incredibly useful, it occurs during page render while objects are still downloading.
     * If you notice your page stalling while loading, all those $(document).ready functions could be the reason why.
     */
    
    $(document).ready(function(){
        
        /* 
         * cache variables
         */        
         
        var	
			$main = $('div#main'),
			$header = $('header.primary'),
			$headerContainer = $header.find('.container'),
			$primAds = $header.find('aside.ads-primary'),
			$comicArticle = $('article.webcomic_post'),
			$navSec = $('nav.secundary'),
			$comicArrows = $('nav.arrows'),
			$comicArrow = $comicArrows.find('a');
		
		/*
		 * init the functions		
		 */	
		 
		// show selected collection in nav
		if ( $comicArticle.length > 0 ) _selectedCollection($navSec);
		
		// move arrownav with scroll
		if($comicArrow.length > 0) _fixedFloat($comicArrow, $('article.comic'));
		
		// fade the header & ads when needed
		$(window).bind( "scroll", function(e) {
			_fadeHeader();
			_fadeTop();
		});
		_fadeHeader();
		_fadeTop();
		
		// reset the ads visibility if they were hidden by previous functions
		$(window).resize(function() {
			_resetAdsTop();
		});
		
		
		/*
		 * functions
		 */
		 
		function _fadeHeader()
		{
			if ($header.css('position') == 'fixed') {
				if ($(window).scrollLeft() > 10 ) $headerContainer.fadeOut(50);
				else $headerContainer.fadeIn(50);
			}
		}
		 
		function _fadeTop()
		{
			if ($primAds.css('position') == 'fixed') {
				if ($(window).scrollTop() > 10 ) $primAds.fadeOut(50);
				else $primAds.fadeIn(50);
			}
		}
		
		function _resetAdsTop() {
			if ($primAds.css('position') != 'fixed') {
				$primAds.removeAttr('style');
			}
		}
		 
		function _selectedCollection($navSec) {
			
			var $items = $navSec.find('li');
			
			// matching class from article
			$items.each(function(){
				var $this = $(this),
					collection = $this.attr('class');
					
				if ( $comicArticle.hasClass(collection) ) {
					$this.addClass('selected');
				}
			});
		}
		
		function _fixedFloat(x, y) {
				var $x = x,
					$y = y;
					
					//You could use the bottom of another object to determine when to stop scrolling the target
					var bottomLimit =
						$y.offset().top
						+ parseInt($y.outerHeight())
						//- parseFloat($y.css('margin-Top').replace(/auto/,0)) //because offset already includes the top margin
						//- parseFloat($y.css('border-Top-Width').replace(/auto/,0));
						
					//var bottomLimit = 1200; //you could instead set a fixed limit when to stop scrolling the target
					
					//total height of the target
					var boxHeight = parseInt($x.outerHeight(true))  
		
					var scrollLimit = bottomLimit - boxHeight;
								
					//get top position in document, parseFloat to get only the number '20' out of '20px', replace resulting 'auto' by 0 (happens when there's no marginTop)
					var top = $x.offset().top - parseFloat($x.css('marginTop').replace(/auto/,0));
					
					var scrollstop = scrollLimit-top + 'px';
								
					$(window).scroll(function (event) {
						// y-position of the scroll
						var scrollTop = $(this).scrollTop();
						
						// if we're below the top AND above the set scroll limit
						// keep the target fixed
						if (scrollTop >= top || scrollTop < scrollLimit ) {
							$x.css('top', 0); //setting the top position back
							$x.addClass('fixed');
						
						} else {
						
						// if we're below or equal to the set scroll limit
						// go back to absolute and leave it there
						} if (scrollTop >= scrollLimit) {
							var currentTop = $x.css('top')	//find the current top position
							$x.removeClass('fixed'); //go back to absolute positioning
							// set its current position: your limit - the original distance from the top 
							$x.css('top', scrollstop);
						
						// the only other case left: the target is back at the original position
						} if ( scrollTop < top) {
						  // otherwise remove it
						  $x.removeClass('fixed');
						  //$this.css('top', originalTop);
						}
					});
			
		}
    });

    /*
     * You can reduce CPU utilization during the page load by binding your jQuery functions to the $(window).load event,
     * which occurs after all objects called by the HTML (including <iframe> content) have downloaded.
     *
     * Superfluous functionality such as drag and drop, binding visual effects and animations, pre-fetching hidden images, etc.,
     * are all good candidates for this technique.
     */
    
    $(window).load(function(){
        // jQuery functions to initialize after the page has loaded.
	});
});