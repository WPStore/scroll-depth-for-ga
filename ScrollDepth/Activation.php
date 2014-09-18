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
class Activation {

	private $file;

	public function __construct( $file ) {
		
		$this->file = $file;

	}

	function check_wp_version( $required_version ) {

		if ( version_compare( get_bloginfo( 'version' ), $required_version, '<' ) ) {

			deactivate_plugins( $this->file );
			wp_die( sprintf( __( "WordPress %s and higher required. The plugin has now disabled itself. On a side note why are you running an old version :( Upgrade!" ), $required_version ) );

		}

	} // END check_wp_version()

	function check_parent_plugin( $method, $parent ) {

		if ( 'class' == $method ) {
			$check = class_exists( $parent );
		} elseif ( 'filepath' ) {
//			$check = "plugin/plugin.php" ($parent)
		}

		if ( ! $check ) {

			deactivate_plugins( $this->file );
			wp_die( __( "Parent plugin not found!" ) );

		}

	} // END check_parent_plugin()

} // END class Activation
