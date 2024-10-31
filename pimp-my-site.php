<?php
/*
 * Plugin Name: Pimp my Site - Christmas Edition
 * Description: Pimp your WordPress Site with Awesome Christmas Effects
 * Author:      Themosaurus
 * Author URI:  https://themosaurus.com/
 * Version:     1.0.0
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: pimp-my-site
 * Domain Path: /languages
 *
 * @package Pimp_My_Site
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Display notice if the full version Pimp my Site is installed
 */
function pimp_my_site_disable_christmas_edition_notice() {
	$deactivate_url = wp_nonce_url( self_admin_url('plugins.php?action=deactivate&plugin=' . plugin_basename( __FILE__ ) ), 'deactivate-plugin_' . plugin_basename( __FILE__ ) ); ?>
	<div class="notice notice-warning">
		<p><?php printf( esc_html__( 'Thank you for buying Pimp my Site! You can safely %1$sdeactivate the Christmas Edition%2$s as it is not required for Pimp my Site to work properly.', 'pimp-my-site' ), '<a href="' . esc_url( $deactivate_url ) . '">', '</a>' ); ?></p>
	</div>
	<?php
}

/**
 * Load plugin.
 */
function pimp_my_site_christmas_edition_loaded() {
	if ( class_exists( 'Pimp_My_Site' ) ) {
		add_action( 'admin_notices', 'pimp_my_site_disable_christmas_edition_notice' );
	}
	else {
		define( 'PIMP_MY_SITE_VERSION', '1.0.0' );
		define( 'PIMP_MY_SITE_PLUGIN_FILE', __FILE__ );
		define( 'PIMP_MY_SITE_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
		define( 'PIMP_MY_SITE_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );
		define( 'PIMP_MY_SITE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

		require_once 'inc/class-pimp-my-site.php';
		require_once 'admin/class-pimp-my-site-admin.php';

		global $pimp_my_site;
		$pimp_my_site = new Pimp_My_Site();

		global $pimp_my_site_admin;
		$pimp_my_site_admin = new Pimp_My_Site_Admin();

		do_action( 'pimp_my_site_christmas_edition_loaded' );
	}
}
add_action( 'plugins_loaded', 'pimp_my_site_christmas_edition_loaded' );
