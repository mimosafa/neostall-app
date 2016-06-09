<?php
/**
 * Plugin Name: Neostall Application
 * Author: Toshimichi Mimoto <mimosafa@gmail.com>
 */

add_action( 'plugins_loaded', '_initialize_neostall_app' );

/**
 * Bootstrap plugin
 *
 * @uses dana_don_boom_boom_doo_autoloader()
 */
function _initialize_neostall_app() {
	if ( ! defined( 'DANA_DON_BOOM_BOOM_DOO' ) || ! DANA_DON_BOOM_BOOM_DOO ) {
		return;
	}

	$loader = dana_don_boom_boom_doo_autoloader();
	$loader->setPsr4( 'NeoSystem\\', __DIR__ . '/class/NeoSystem' );
	$loader->setPsr4( 'Neostall\\',  __DIR__ . '/class' );

	Neostall\Repositories::init();

	if ( is_admin() ) {
		$k = new mimosafa\WP\UI\Post( 'kitchencar' );
		$lmc = Neostall\UI\MetaBox\LegacyMenuContent::getInstance();
		$box = $lmc->meta_box()->context( 'normal' )->priority( 'high' );
		$k->add_meta_box( $box );
	}

}
