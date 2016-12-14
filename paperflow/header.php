<?php
/**
 * The header for our theme.
 *
 * @package paperflow
 * @author Alexander Dümont
 * @link newtork.de
 * @license GPLv2 or later
 */

?><!DOCTYPE html><!-- saved from url=(0016)localhost -->
<html lang="en">
<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
	<meta name="description" content="Paper Page Template by newtork.github.io" />
	<meta name="keywords" content="paper, page, template, html, newtork" />
	<meta name="author" content="Alexander Dümont" />
	
	<link rel="stylesheet" type="text/css" media="" href="wp-content/themes/paperflow/css/style.css" />
	<link rel="stylesheet" type="text/css" media="(min-width: 500px)" href="wp-content/themes/paperflow/css/fixes.css" />
	<link rel="stylesheet" type="text/css" media="(max-width: 500px)" href="wp-content/themes/paperflow/css/fallback.css" />
	<link rel="stylesheet" type="text/css" media="" href="wp-content/themes/paperflow/css/custom.css" />
	
	<script type="text/javascript" src="wp-content/themes/paperflow/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="wp-content/themes/paperflow/js/modernizr-custom.js"></script>
	<script type="text/javascript" src="wp-content/themes/paperflow/js/jsrender.min.js"></script>
	<script type="text/javascript" src="wp-content/themes/paperflow/js/jquery.touchSwipe-1.6.min.js"></script>
	<script type="text/javascript" src="wp-content/themes/paperflow/js/jquery.flips.js"></script>
	
	<script id="pageTmpl" type="text/x-jsrender">
		<div class="{{:theClass}}" style="{{:theStyle}}">
			<div class="front">
				<div class="outer">
					<div class="content" style="{{:theContentStyleFront}}">
						<div class="inner">{{:theContentFront}}</div>
					</div>
				</div>
			</div>
			<div class="back">
				<div class="outer">
					<div class="content" style="{{:theContentStyleBack}}">
						<div class="inner">{{:theContentBack}}</div>
					</div>
				</div>
			</div>
		</div>			
	</script>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="flipout">
		<div id="flip" class="container" style="display:none">
		
			<div class="f-page f-cover">
				<div class="cover-elements">
					<h1>
						<?php bloginfo( 'name' ); ?>
						<span><?php echo get_bloginfo( 'description', 'display' ); ?></span>
					</h1>
					<div class="f-cover-story">
						<?php 						
						$thumbnail = get_custom_logo();
						the_thumbnail_background("img-feat", $thumbnail);
						?>
						<span>Time to straighten up your Latin</span>
						I've used a lot of lorem ipsum from now on.
					</div>
				</div>
			</div>
			