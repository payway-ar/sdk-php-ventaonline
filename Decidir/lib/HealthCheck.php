<?php
namespace Decidir;

class HealthCheck{
	public $data = array();
	public $header_data = NULL;
	public $mode = NULL;
	public $instanceHk = NULL;

	public function __construct($header_http, $mode){
		$this->header_http = $header_http;
		$this->mode = $mode;

		$this->instanceHk = new \Decidir\RESTClient($this->header_http, $this->mode);
	}	

	public function getStatus($data){
		$this->data = $data;

		$RESTResponse = $this->instanceHk->get("healthcheck", json_encode($this->data));
		$ArrayResponse = $this->toArray($RESTResponse);

		return new \Decidir\Healthcheck\HealthCheckResponse($ArrayResponse);
	}

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}

}