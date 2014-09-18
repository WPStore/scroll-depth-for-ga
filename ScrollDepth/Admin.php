<?php
/**
 * @author    WPStore.io <code@wpstore.io>
 * @copyright Copyright (c) 2014, WPStore.io
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPStore\ScrollDepth
 */

namespace WPStore\ScrollDepth;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @todo
 *
 * @since 0.0.1
 */
class Admin {

	public function __construct() {

		add_action( 'ga_add_sections', array( $this, 'add_sections' ) );
		add_action( 'ga_add_fields', array( $this, 'add_fields' ) );

	} // END __construct()

	public function add_sections( $sections ) {

		$sections['scroll_depth'] = array(
			'tab'	 => 'advanced',
			'title'	 => __( 'Scroll Depth', 'scroll-depth' ),
			'desc'	 => __( 'Track how far visitors scroll down on pages', 'scroll-depth' ),
		);

		return $sections;

	}

	public function add_fields( $fields ) {

		$fields['scroll_depth'] = array(
			'google_ua'	 => array(
				'label'	 => __( 'Text Input (integer validation)', 'web-analytics' ),
				'desc'	 => __( 'Text input description', 'web-analytics' ),
				'type'	 => 'google_ua',
			),
			'textarea'	 => array(
				'label'	 => __( 'Textarea Input', 'wedevs' ),
				'desc'	 => __( 'Textarea description', 'wedevs' ),
				'type'	 => 'textarea'
			),
			'checkbox'	 => array(
				'label'	 => __( 'Checkbox', 'wedevs' ),
				'desc'	 => __( 'Checkbox Label', 'wedevs' ),
				'type'	 => 'checkbox'
			),
			'radio'		 => array(
				'label'		 => __( 'Radio Button', 'wedevs' ),
				'desc'		 => __( 'A radio button', 'wedevs' ),
				'type'		 => 'radio',
				'options'	 => array(
					'yes'	 => 'Yes',
					'no'	 => 'No'
				)
			),
		);

		return $fields;

	}

} // END class Admin
