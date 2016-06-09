<?php
namespace Neostall\Model;

abstract class WP_Post {

	protected $post;
	protected $post_id;
	protected $post_type = '';

	protected $postarr_for_update = [];

	public function __construct( $post = null ) {
		if ( ! $post = get_post( $post ) ) {
			throw new \Exception( 'Invalid.' );
		}
		if ( $this->post_type && get_post_type( $post ) !== $this->post_type ) {
			throw new \Exception( 'Invalid.' );
		}
		$this->post = $post;
		$this->post_id = (int) $post->ID;
		add_action( 'shutdown', [ $this, 'update' ] );
	}

	public function __get( $name ) {
		$method = 'get_' . $name;
		if ( method_exists( $this, $method ) ) {
			return $this->$method();
		}
		if ( $return = $this->$post->$name ) {
			return $return;
		}
		return null;
	}

	public function __set( $name, $value ) {
		//
	}

	public function update() {
		if ( empty( $this->postarr_for_update ) || ! doing_action( 'shutdown' ) ) {
			return;
		}
		$postarr = array_merge( $this->postarr_for_update, [ 'ID' => $this->post_id ] );
		$post_id = wp_update_post( $postarr, true );
		//
	}

}
