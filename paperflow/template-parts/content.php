<?php
/**
 * Template part for displaying posts.
 *
 * @package paperflow
 * @author Alexander Dümont
 * @link newtork.de
 * @license GPLv2 or later
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
	<?php the_post_thumbnail('full'); ?>

	<div class="entry__info">
		<?php the_title( '<h3 class="entry__title">', '</a></h3>' ); ?>
		<?php if ( 'post' === get_post_type() ) : ?>
			<span class="entry__meta">
			<?php paperflow_posted_on(); ?>
			</span>
		<?php endif; ?>
	</div>

	<div class="entry__content">
		<?php the_content(); ?>
	</div>
</div>
