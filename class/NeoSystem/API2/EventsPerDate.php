<?php
namespace NeoSystem\API2;

class EventsPerDate extends API {

	public function init( $date ) {
		if ( $date = filter_var( $date, \FILTER_SANITIZE_URL ) ) {
			$this->args['date'] = $date;
		}
	}

	public function get_array( $date ) {
		if ( $raw_array = parent::get_array( $date ) ) {
			return $this->_fix_array( $raw_array );
		}
		return false;
	}

	private function _fix_array( Array $raw_array ) {
		$return = [];
		for ( $i = 0; $i < count( $raw_array ); $i++ ) {
			$array = $raw_array[$i];
			$event_name = $array['eve_name'];
			$event_id   = $array['event_id'];
			$car_id     = self::array_flatten( $array['car_id'] );
			$return[$i] = compact( 'event_name', 'event_id', 'car_id' );
		}
		return $return;
	}

}
