<?php
namespace NeoSystem\API2;

/**
 * @uses  NEOSYSTEM_API2_TOKEN  Maybe defined in wp-config.php.
 */
abstract class API {

	protected $_token = '';
	protected $_endpoint = 'http://p-man.net/api_test/api2.php';
	protected $args = [];

	public function __construct() {
		if ( defined( 'NEOSYSTEM_API2_TOKEN' ) ) {
			$this->_token = NEOSYSTEM_API2_TOKEN;
		}
	}

	abstract protected function init( $arg );

	public function get_json( $arg ) {
		$this->init( $arg );
		$data = array_merge( $this->args, [ 'token' => $this->_token ] );
		$url  = sprintf( '%s?%s', $this->_endpoint, http_build_query( $data ) );
		return file_get_contents( $url ) ?: false;
	}

	public function get_array( $arg ) {
		if ( $json = $this->get_json( $arg ) ) {
			return json_decode( $json, true );
		}
		return false;
	}

	/**
	 * @see http://kakakakakku.hatenablog.com/entry/2015/11/18/014129
	 */
	protected static function array_flatten( $array ) {
		return iterator_to_array(
			new \RecursiveIteratorIterator(
				new \RecursiveArrayIterator( $array )
			),
			false
		);
	}

}
