<?php
namespace Neostall;

/**
 * Initialize Post Types & Taxonomies
 *
 * @uses mimosafa\WP\CoreRepository\Factory
 */
class Repositories {

	public static function init() {
		static $instance;
		$instance ?: $instance = new self();
	}

	private function __construct() {
		$cr = new \mimosafa\WP\CoreRepository\Factory();

		/**
		 * Public & Archivable Post Type
		 */
		$cr->set_defaults( 'public=1&has_archive=1' );

		$space = $cr->create_post_type( 'space' );
		$kitchencar = $cr->create_post_type( 'kitchencar' );
		$event = $cr->create_post_type( 'event' );

		/**
		 * Public Post Type
		 */
		$cr->set_defaults( 'has_archive=0' );

		$news = $cr->create_post_type( 'news' );
		$management = $cr->create_post_type( 'management' );

		/**
		 * Private & List Viewable Post Type
		 */
		$cr->set_defaults( 'public=0&show_ui=1' );

		$menu = $cr->create_post_type( 'menu', 'alias=menu_item' );
		$vendor = $cr->create_post_type( 'vendor' );
		$activity = $cr->create_post_type( 'activity' );

		/**
		 * Private & Editable Post Type
		 */
		$cr->set_defaults( 'show_in_menu=0' );

		$spot = $cr->create_post_type( 'spot' );
		$content = $cr->create_post_type( 'menu_content' );

		/**
		 * Public Taxonomy
		 */
		$cr->reset_defaults( 'public=1' );

		$series = $cr->create_taxonomy( 'series' );
		$series->bind( $event );

		$genre = $cr->create_taxonomy( 'genre' );
		$genre->bind( [ $menu, $content, $vendor, $kitchencar ] );

		$region = $cr->create_taxonomy( 'region', 'hierarchical=1' );
		$region->bind( [ $event, $space ] );



		$space->label = is_admin() ? 'ランチスペース' : '所在地と出店スケジュール';
		$space->menu_icon = 'dashicons-location-alt';
		$space->support_editor = false;
		$space->support_trackbacks = false;
		$space->support_custom_fields = true;

		$event->label = is_admin() ? 'イベント' : 'イベント情報';
		$event->menu_icon = 'dashicons-palmtree';
		$event->support_custom_fields = true;

		$kitchencar->label = is_admin() ? 'キッチンカー' : 'ネオ屋台のご紹介';
		$kitchencar->support_thumbnail = true;
		# $kitchencar->support_editor = false;
		$kitchencar->support_custom_fields = true;

		$news->support_custom_fields = true;

		$content->support_title = false;
	}

}
