<?php
namespace Neostall\Route;
use Neostall\UI;

class Kitchencars extends \mimosafa\WP\Route\Posts {

	protected $post_types = 'kitchencar';

	public function dispatch( $args ) {
		extract( $args );
		if ( isset( $pagenow ) ) {
			if ( in_array( $pagenow, [ 'post.php', 'post-new.php' ], true ) ) {
				$this->init_post_ui( $args );
			}
			else if ( $pagenow === 'edit.php' ) {
				$this->init_edit_ui( $args );
			}
		}
		else {
			$this->init_frontend( $args );
		}
	}

	protected function init_post_ui( Array $args ) {
		new UI\File\Kitchencar();
	}
	protected function init_edit_ui( Array $args ) {
		var_dump( __METHOD__, $args );
	}
	protected function init_frontend( Array $args ) {
		var_dump( __METHOD__, $args );
	}

}