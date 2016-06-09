<?php
namespace Neostall\UI\MetaBox;

class LegacyMenuContent {

	private $meta_box;

	public static function getInstance() {
		static $instance;
		return $instance ?: $instance = new self();
	}

	private function __construct() {
		$this->meta_box = new \mimosafa\WP\UI\MetaBox( 'legacy-menu-contents' );
		$this->meta_box
			->title( 'Default Menu Contents (Legacy...)' )
			->callback( [ $this, 'meta_box_callback' ] )
		;
	}

	public function meta_box() {
		return $this->meta_box;
	}

	public function meta_box_callback( \WP_Post $post ) {
		$args = [ 'post' => $post ];
		$table = new \mimosafa\WP\UI\FormTable();
		$table
			->field( 'legacy-menus', 'Menus', [ $this, 'menus' ] )
				->callback_args( array_merge( $args, [ 'id' => 'legacy-menus' ] ) )
			->field( 'legacy-genre', 'Genres', [ $this, 'genres' ] )
				->callback_args( $args )
			->field( 'legacy-text', 'Text', [ $this, 'text' ] )
				->callback_args( array_merge( $args, [ 'id' => 'legacy-text' ] ) )
		;
		$table->display();
	}

	public function menus( Array $args ) {
		$post_id = self::postID( $args );
		$menus = get_post_meta( $post_id, 'legacy_menus', true );
		return
			sprintf(
				'<input type="text" name="legacy_menus" class="regular-text" id="%s" value="%s" />',
				esc_attr( $args['id'] ),
				esc_attr( $menus )
			)
		;
	}

	public function genres( Array $args ) {
		$post_id = self::postID( $args );
		$genreOBJs = get_the_terms( $post_id, 'genre' );
		return var_export( $genreOBJs, true );
	}

	public function text( Array $args ) {
		$post = $args['post'];
		return apply_filters( 'the_content', $post->post_content );
	}

	private function postID( Array $args ) {
		return $args['post']->ID;
	}

}
