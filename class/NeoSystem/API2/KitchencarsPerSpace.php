<?php
namespace NeoSystem\API2;

class KitchencarsPerSpace extends API {

	protected function init( $space ) {
		if ( $space = filter_var( $space, \FILTER_SANITIZE_URL ) ) {
			$this->args['web_event_name'] = $space;
		}
	}

	public function get_array( $space ) {
		if ( $raw_array = parent::get_array( $space ) ) {
			return $this->_fix_array( $raw_array );
		}
		return false;
	}

	private function _fix_array( Array $raw_array ) {
		$return = [];
		for ( $i = 0; $i < count( $raw_array ); $i++ ) {
			$array  = $raw_array[$i];
			$date   = $array['date'];
			$car_id = self::array_flatten( $array['car_id'] );
			$return[$i] = compact( 'date', 'car_id' );
		}
		return $return;
	}

}
