<?php
namespace Neostall\UI\MetaBox;

class LegacyMenuContent extends \mimosafa\WP\UI\MetaBox {

	protected $id = 'legacy-menu-contents';
	protected $title = 'Default Menu Contents (Legacy...)';

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
