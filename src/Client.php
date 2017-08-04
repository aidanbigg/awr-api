<?php

namespace AWR;

class Client {

	private $api_key;

	private $base_url = 'https://api.awrcloud.com/sync.php?';

	/**
	 * Client constructor.
	 *
	 * TODO: Implement error handling.
	 *
	 * @param $api_key
	 */
	public function __construct( $api_key = false ) {

		if ( $api_key ) {
			$this->api_key = $api_key;
			// TODO: Test API key
		} else {
			// TODO: ErrorException
			echo 'No API key supplied';
			exit(); // TODO: Remove echo error
		}
	}

	public function request( $parameters, $inputs, $method ) {

		$request = $this->buildRequest( $parameters, $inputs, $method );

		$response = file_get_contents( $request['url'], false, $request['context'] );

		return $this->handleResponse( json_decode( $response ) );
	}

	public function handleResponse( $response ) {
		// TODO: improve error handling
		switch ( $response ) {
			case "0":
				return true;
			case "2":
				echo "Invalid API token";
				return false;
			case "4":
				echo "Inputs parameter cannot be empty";

				return false;
			default:
				return $response;
		}
	}

	/**
	 * @param $parameters
	 * @param $inputs
	 * @param $method
	 *
	 * @return array
	 */
	private function buildRequest( $parameters, $inputs, $method ) {

		// set base URL & API Token
		$url = $this->base_url . 'token=' . $this->api_key;

		// append parameters to request
		foreach ( $parameters as $parameter_key => $parameter_value ) {
			$url .= '&' . $parameter_key . '=' . urlencode( $parameter_value );
		}

		// set data
		$data = array(
			'inputs' => json_encode( $inputs )
		);

		// set options
		$options = array(
			'http' => array(
				"header"  => "Content-type: application/x-www-form-urlencoded\r\n",
				"method"  => $method,
				"content" => http_build_query( $data )
			)
		);

		// create context stream
		$context = stream_context_create( $options );

		// return
		return array(
			'url'     => $url,
			'context' => $context
		);
	}
}
