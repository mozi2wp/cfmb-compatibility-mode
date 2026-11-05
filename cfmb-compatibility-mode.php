<?php
/**
 * Plugin Name:       CFMB Compatibility Mode
 * Plugin URI:        https://mozi2wp.com/cfmb
 * Description:       Lets themes built for ACF keep using get_field(), have_rows() and the other ACF functions with CFMB - Custom Fields Meta Box.
 * Version:           1.0.0
 * Requires at least: 6.6
 * Requires PHP:      7.4
 * Requires Plugins:  custom-fields-meta-box
 * Author:            Mozi2WP
 * Author URI:        https://mozi2wp.com
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       cfmb-compatibility-mode
 *
 * @package CFMB\Compat
 */

defined( 'ABSPATH' ) || exit;

define( 'CFMB_COMPAT_VERSION', '1.0.0' );

require_once __DIR__ . '/src/Compat_Mode.php';

// Priority 1: after every plugin file has loaded, so ACF, SCF and CFMB are all detectable, and before themes.
add_action( 'plugins_loaded', array( new CFMB\Compat\Compat_Mode( __DIR__ ), 'boot' ), 1 );
