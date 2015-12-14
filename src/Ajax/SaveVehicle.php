<?php

namespace Never5\WPCarManager\Ajax;

use Never5\WPCarManager\Vehicle;

class SaveVehicle extends Ajax {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct( 'save_vehicle' );
	}

	/**
	 * AJAX callback method
	 *
	 * @return void
	 */
	public function run() {

		$return = array( 'success' => false, 'errors' => array(), 'vehicle' => 0 );

		// check nonce
		$this->check_nonce();

		// check if vehicle ID is set
		if ( ! isset( $_POST['vehicle_id'] ) ) {
			return;
		}

		// vehicle ID (can be 0 for new vehicle)
		$vehicle_id = absint( $_POST['vehicle_id'] );

		// check if data is posted
		if ( ! isset( $_POST['data'] ) ) {
			return;
		}

		// put data in $data
		parse_str( $_POST['data'], $data );

		// validate data
		// @todo validate data

		/**
		 * Data Validation
		 */
		try {
			$frdate_dt = new \DateTime( $data['frdate'] );
		} catch ( \Exception $e ) {
			$return['errors'] = array(
				'id'  => 'frdate',
				'msg' => __( 'Incorrect First Registration Date format' )
			);
		}

		// only proceed if errors is empty
		if ( ! empty( $return['errors'] ) ) {

			// @todo escape data

			/**
			 * Data Sanitation
			 */

			// @todo save data

			// create Vehicle object
			/** @var Vehicle\Car $vehicle */
			$vehicle = wp_car_manager()->service( 'vehicle_factory' )->make( 0 );

			// Set Vehicle data in object
			$vehicle->set_title( $data['title'] );
			$vehicle->set_description( $data['description'] );
			$vehicle->set_condition( $data['condition'] );
			$vehicle->set_make( $data['make'] );
			$vehicle->set_model( $data['model'] );
			$vehicle->set_frdate( $frdate_dt );
			$vehicle->set_price( $data['price'] );
			$vehicle->set_mileage( $data['mileage'] );
			$vehicle->set_fuel_type( $data['fuel_type'] );
			$vehicle->set_color( $data['color'] );
			$vehicle->set_body_style( $data['body_style'] );
			$vehicle->set_transmission( $data['transmission'] );
			$vehicle->set_engine( $data['engine'] );
			$vehicle->set_doors( $data['doors'] );


		}

		// send JSON
		wp_send_json( $return );

		// bye
		exit;
	}

}