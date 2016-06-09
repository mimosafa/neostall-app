<?php
namespace NeoSystem\API2;

class SchedulesForKitchencar extends API {

	protected function init( $kitchencar ) {
		if ( $kitchencar = filter_var( $kitchencar, \FILTER_SANITIZE_URL ) ) {
			$this->args['car_id'] = $kitchencar;
		}
	}

}
