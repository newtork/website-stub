<?php
/**
 * paperflow functions and definitions.
 *
 * @package paperflow
 * @author Alexander Dümont
 * @link newtork.de
 * @license GPLv2 or later
 */

if ( ! function_exists( 'paperflow_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function paperflow_setup() {
  /*
   * Make theme available for translation.
   * Translations can be filed in the /languages/ directory.
   */
  load_theme_textdomain( 'paperflow', get_template_directory() . '/languages' );

  // Add default posts and comments RSS feed links to head.
  add_theme_support( 'automatic-feed-links' );

  /*
   * Let WordPress manage the document title.
   * By adding theme support, we declare that this theme does not use a
   * hard-coded <title> tag in the document head, and expect WordPress to
   * provide it for us.
   */
  add_theme_support( 'title-tag' );

  /*
   * Enable support for Post Thumbnails on posts and pages.
   */
  add_theme_support( 'post-thumbnails' );

  /*
   * This theme uses wp_nav_menu() in one location.
   */
  register_nav_menus( array(
    'primary' => esc_html__( 'Primary', 'paperflow' ),
    'social'  => esc_html__( 'Social Links Menu', 'paperflow' ),
  ) );

  /*
   * Switch default core markup for search form, comment form, and comments
   * to output valid HTML5.
   */
  add_theme_support( 'html5', array(
  ) );

  /*
   * Enable support for Post Formats.
   */
  add_theme_support( 'post-formats', array(
    'image',
    'video',
  ) );

  // Add theme support for Custom Logo.
  add_theme_support( 'custom-logo', array(
    'width'       => 400,
    'height'      => 400,
    'flex-width'  => true,
  ) );

  // Set up the WordPress core custom background feature.
  add_theme_support( 'custom-background', apply_filters( 'paperflow_custom_background_args', array(
    'default-color' => 'aa5555',
    'default-image' => '',
  ) ) );

  /*
   * Enable support editor-style on WordPress dashboard.
   */
  add_editor_style( array(
    // TODOME 'editor-style.css',
  ) );
}
endif;
add_action( 'after_setup_theme', 'paperflow_setup' );


// Filter the output of logo to fix Googles Error about itemprop logo
function paperflow_custom_logo() {
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $html = wp_get_attachment_image( $custom_logo_id, 'full', false, array('class' => 'custom-logo'));
    return $html;   
}
add_filter( 'get_custom_logo',  'paperflow_custom_logo' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function paperflow_content_width() {
  $GLOBALS['content_width'] = apply_filters( 'paperflow_content_width', 700 );
}
add_action( 'after_setup_theme', 'paperflow_content_width', 0 );



// add category nicenames in body and post class
function paperflow_post_class( $classes ) {
	global $post;
	
	$classes[] = 'box';
	
	// width
	$pw = get_post_meta( $post->ID, 'paperflow_post_width', true );
	if( $pw && $pw>0 )
	 $classes[] = "w-$pw";
 
	// height
	$ph = get_post_meta( $post->ID, 'paperflow_post_height', true );
	if( $ph && $ph>0 )
	 $classes[] = "h-$ph";
 
	// image size
	$ip = get_post_meta( $post->ID, 'paperflow_post_image_position', true );
	if( $ip )
	 $classes[] = "$ip";
 
	// image width
	$iw = get_post_meta( $post->ID, 'paperflow_post_image_width', true );
	if( $iw && $iw>0 )
	 $classes[] = "img-width$iw";
 
	// image height
	$ih = get_post_meta( $post->ID, 'paperflow_post_image_height', true );
	if( $ih && $ih>0 )
	 $classes[] = "img-height$ih";
 
	return $classes;
}
add_filter( 'post_class', 'paperflow_post_class' );


/*
 * Register excerpt length.
 */
function custom_excerpt_length( $length ) {
	return 120;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function wpdocs_excerpt_more( $more ) {
  return '[&hellip;]';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/**
 * Enqueue scripts and styles.
 */
function paperflow_scripts() {
  $url = get_template_directory_uri();
  $theme   = wp_get_theme();
  $version = $theme->get( 'Version' );

  wp_enqueue_style( 'paperflow-style', $url . '/style.css' );

  // TODOME 
  if ( is_child_theme() ) {
  //   wp_enqueue_style( get_stylesheet(), get_stylesheet_uri(), array( 'paperflow-style' ), $version);
  }

  
  // TODOME wp_enqueue_script( 'paperflow-main', $url . '/js/bundle.js', array('jquery'), $version, true );

  // TODOME 
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
  //  wp_enqueue_script( 'comment-reply' );
  }
}
// TODOEMEadd_action( 'wp_enqueue_scripts', 'paperflow_scripts' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';





/**
 * Wordpress Meta Box
 */
require get_template_directory() . '/post-meta.inc.php';



function the_thumbnail_background( $classes=null ) {
	$tag = get_the_post_thumbnail( null, 'full' );
	
	// get the url from ... src="URL" ...
	if($tag && $pos = strpos($tag, "src=")) {
		$tag = substr($tag, $pos+4);
		$url = substr($tag, 1, strpos($tag, substr($tag,0,1), 1)-1);
		
		$classes = $classes && count($classes) ? 'class="'.(is_array($classes) ? implode(" ", $classes) : $classes).'"' : "";
		echo "<div $classes style=\"background-image:url('$url');\"></div>";
	}
}
