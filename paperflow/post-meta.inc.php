<?php

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 *
 * @link http://metabox.io/docs/registering-meta-boxes/
 */
add_filter( 'rwmb_meta_boxes', 'paperflow_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * Remember to change "your_prefix" to actual prefix in your project
 *
 * @param array $meta_boxes List of meta boxes
 *
 * @return array
 */
function paperflow_register_meta_boxes( $meta_boxes ) {
	/**
	 * prefix of meta keys (optional)
	 * Use underscore (_) at the beginning to make keys hidden
	 * Alt.: You also can make prefix empty to disable it
	 */
	// Better has an underscore as last sign
	$prefix = 'paperflow_';
	$prefix_esc = 'paperflow_';
	
	// 1st meta box
	$meta_boxes[] = array(
		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
		'id'         => 'standard',
		// Meta box title - Will appear at the drag and drop handle bar. Required.
		'title'      => esc_html__( 'Positioning', $prefix_esc ),
		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
		'post_types' => array( 'post', 'page' ),
		// Where the meta box appear: normal (default), advanced, side. Optional.
		'context'    => 'normal',
		// Order of meta box: high (default), low. Optional.
		'priority'   => 'high',
		// Auto save: true, false (default). Optional.
		'autosave'   => true,
		// List of meta fields
		'fields'     => array(
		
			// PRIORITY
			array(
				'name' => esc_html__( 'Priority index', $prefix_esc ),
				'id'   => "{$prefix}post_priority",
				'type' => 'number',
				'min'  => 0,
				'step' => 1,
				'std'  => 1,
			),
			
			// POST WIDTH
			array(
				'name' => esc_html__( 'Box width', $prefix_esc ),
				'id'   => "{$prefix}post_width",
				'desc' => esc_html__( 'The relative width of the post in regards to the page.', $prefix_esc ),
				'type' => 'range',
				'min'  => 25,
				'max'  => 100,
				'step' => 5,
				'std'  => 50,
			),
			
			// POST HEIGHT
			array(
				'name' => esc_html__( 'Box height', $prefix_esc ),
				'id'   => "{$prefix}post_height",
				'desc' => esc_html__( 'The relative height of the post in regards to the page.', $prefix_esc ),
				'type' => 'range',
				'min'  => 25,
				'max'  => 100,
				'step' => 5,
				'std'  => 50,
			),
			
			// FEATURED IMAGE POSITION
			array(
				'name'    => esc_html__( 'Feature image position', $prefix_esc ),
				'id'      => "{$prefix}post_image_position",
				'type'    => 'radio',
				'inline'  => false,
				'options' => array(
					'' => esc_html__( 'top', $prefix_esc ),
					'box-img-left' => esc_html__( 'left', $prefix_esc ),
					'box-img-right' => esc_html__( 'right', $prefix_esc ),
				),
			),
			
			
			// FEATURED IMAGE WIDTH
			array(
				'name'        => esc_html__( 'Feature image width', $prefix_esc ),
				'id'          => "{$prefix}post_image_width",
				'type'        => 'select',
				'options'     => array(
					'' => esc_html__( 'Auto', $prefix_esc ),
					'20' => esc_html__( '20%', $prefix_esc ),
					'30' => esc_html__( '30%', $prefix_esc ),
					'40' => esc_html__( '40%', $prefix_esc ),
					'50' => esc_html__( '50%', $prefix_esc ),
					'60' => esc_html__( '60%', $prefix_esc ),
					'70' => esc_html__( '70%', $prefix_esc ),
					'80' => esc_html__( '80%', $prefix_esc ),
				),
				'multiple'    => false,
				'std'         => '',
				//'placeholder' => esc_html__( 'Select an Item', 'your-prefix' ),
			),
			
			
			// FEATURED IMAGE HEIGHT
			array(
				'name'        => esc_html__( 'Feature image height', $prefix_esc ),
				'id'          => "{$prefix}post_image_height",
				'type'        => 'select',
				'options'     => array(
					'' => esc_html__( 'Auto', $prefix_esc ),
					'20' => esc_html__( '20%', $prefix_esc ),
					'30' => esc_html__( '30%', $prefix_esc ),
					'40' => esc_html__( '40%', $prefix_esc ),
					'50' => esc_html__( '50%', $prefix_esc ),
					'60' => esc_html__( '60%', $prefix_esc ),
					'70' => esc_html__( '70%', $prefix_esc ),
					'80' => esc_html__( '80%', $prefix_esc ),
				),
				'multiple'    => false,
				'std'         => '',
				//'placeholder' => esc_html__( 'Select an Item', 'your-prefix' ),
			),
			
		),
	);
	// 2nd meta box
	$meta_boxes[] = array(
		'title' => esc_html__( 'Advanced Fields', $prefix_esc ),
		'fields' => array(
		
			// OEMBED
			array(
				'name' => esc_html__( 'Custom media HTML', $prefix_esc ),
				'id'   => "{$prefix}oembed",
				'desc' => esc_html__( 'Input for videos, audios from Youtube, Vimeo and all supported sites by WordPress.', $prefix_esc ),
				'type' => 'oembed',
			),
			
		),
	);
	
	// 2nd meta box
	$meta_boxes[] = array(
		'title' => esc_html__( 'Event Details', $prefix_esc ),
		'fields' => array(
		
						
			// CHECKBOX
			array(
				'name' => esc_html__( 'Is this an event?', $prefix_esc ),
				'id'   => "{$prefix}event_is",
				'type' => 'checkbox',
				// Value can be 0 or 1
				'std'  => 0,
			),
			
			// DATE
			array(
				'name'       => esc_html__( 'Date', $prefix_esc ),
				'id'         => "{$prefix}event_date",
				'type'       => 'date',
				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
				'js_options' => array(
					'appendText'      => esc_html__( '(yyyy-mm-dd)', $prefix_esc ),
					'dateFormat'      => esc_html__( 'yy-mm-dd', $prefix_esc ),
					'changeMonth'     => true,
					'changeYear'      => true,
					'showButtonPanel' => true,
				),
			),
			
			// Map requires at least one address field (with type = text)
			array(
				'id'   => "{$prefix}address",
				'name' => __( 'Address', $prefix_esc ),
				'type' => 'text',
				'std'  => __( 'Berlin, Germany', $prefix_esc ),
			),
			array(
				'id'            => 'map',
				'name'          => __( 'Location', $prefix_esc ),
				'type'          => 'map',
				// Default location: 'latitude,longitude[,zoom]' (zoom is optional)
				'std'           => '52.5200,13.4050,10',
				// Name of text field where address is entered. Can be list of text fields, separated by commas (for ex. city, state)
				'address_field' => "{$prefix}address",
				'api_key'       => '', //TODOME // https://metabox.io/docs/define-fields/#section-map
			),
			
			// URL
			array(
				'name' => esc_html__( 'External event page', $prefix_esc ),
				'id'   => "{$prefix}url_facebook",
				'type' => 'url',
				'std'  => '',
				// CLONES: Add to make the field cloneable (i.e. have multiple value)
				'clone' => true,
			),
		),
	);
	return $meta_boxes;
}