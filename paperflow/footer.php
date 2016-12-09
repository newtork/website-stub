<?php
/**
 * The template for displaying the footer.
 *
 * @package paperflow
 * @author Alexander Dümont
 * @link newtork.de
 * @license GPLv2 or later
 */
?>

<!-- tempalte footer from here -->
			<div class="f-page">
				<div class="f-title">
					<h2><!-- title --></h2>
				</div>
				<div class="box wh-page"></div>
				<div class="box wh-page"></div>
			</div>
			<div class="f-page f-cover-back">
				<div id="codrops-ad-wrapper">
					
				</div>
			</div>
		</div>
	</div>

<?php wp_footer(); ?>
	
		
	<script type="text/javascript">
	$(function() {
		window.jQuery = $;
		var $container = $( '#flip' );
		if(!Modernizr.csstransforms3d || !Modernizr.csstransitions || $( window ).width() <= 500 ) {
			$pages = $container.children().hide();
			$pages.show();
		}
		else {
			window.xy = $container.flips();
			$( window ).trigger("statechange.flips");
		}
		$container.show();
	});
			
	</script>
</body>
</html>

