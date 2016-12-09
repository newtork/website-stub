<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package paperflow
 * @author Alexander Dümont
 * @link newtork.de
 * @license GPLv2 or later
 */

if ( ! function_exists( 'paperflow_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function paperflow_posted_on() {
  $time_string = '<time class="entry-date" datetime="%1$s">%2$s</time>';
  $time_string = sprintf( $time_string,
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );

  $posted_on = sprintf( $time_string );
  echo $posted_on;
}
endif;

