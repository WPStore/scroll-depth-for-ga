<?php
/**
 * @author    WPStore.io <code@wpstore.io>
 * @copyright Copyright (c) 2014, WPStore.io
 * @license   http://www.gnu.org/licenses/gpl-2.0.html GPL-2.0+
 * @package   WPStore\WebAnalytics
 */

namespace WPStore\ScrollDepth;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) { exit; }

/**
 * @todo
 *
 * @since 0.0.1
 */
class Frontend {

	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
//		add_action( 'wp_head', array( $this, 'output_parameters' ) );

	} // END __construct()

	public function enqueue_scripts() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_script( 'jquery-scrolldepth', plugins_url( '/assets/jquery-scrolldepth/', \WPStore\ScrollDepth()->get_file() ) . "jquery.scrolldepth{$suffix}.js", array( 'jquery' ), '0.6' ); // , true // move to footer?

	} // END enqueue_scripts()

	public function output_parameters() {

		// global $wp_scroll_depth_vals;

		$options = get_option( 'ga_frontend' ); // all ga options for the frontend // @todo use the subset added for the scroll depth

		echo "<script>\n\tjQuery( document ).ready(function(){\n\t\tjQuery.scrollDepth({\n";
		foreach ($wp_scroll_depth_vals['option_fields'] as $option_name => $option_attributes){
			echo "\t\t\t" . $option_name . ': ';
			if ('list' == $wp_scroll_depth_vals['option_fields'][$option_name]['type']){
				$v = preg_replace(
					'/\,\s*/', // pattern
					"', '", // replacement
					 get_option( $option_name, $wp_scroll_depth_vals['option_fields'][$option_name]['default']), // subject
					-1 // limit
				);
				echo "['" . $v . "']";
			} else {
				echo get_option( $option_name, $wp_scroll_depth_vals['option_fields'][$option_name]['default']);
			}
			echo ",\n";
		}
		echo "\t});\n});\n</script>\n";

	} // END output_parameters()

} // END class
