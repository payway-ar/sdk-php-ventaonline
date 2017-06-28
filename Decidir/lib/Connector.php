<?php
namespace Decidir;

define('DECIDIR_VERSION','1.0.4');

class connector{
	private $header_http = array();
	private $mode = NULL;
	private $healthCheck = NULL;
	private $paymentInstance = NULL;
	private $tokenInstance = NULL;

	public function __construct($header_http_array, $mode){

		$this->mode = $mode;
		$this->header_http = $header_http_array;

		$this->healthCheck = new \Decidir\HealthCheck($this->header_http, $this->mode);
		$this->paymentInstance = new \Decidir\Payment($this->header_http, $this->mode);
		$this->tokenInstance = new \Decidir\Tokenization($this->header_http, $this->mode);
	}
	
	public function healthcheck(){
		return $this->healthCheck;
	}

	public function payment(){
		return $this->paymentInstance;
	}

	public function cardToken(){
		return $this->tokenInstance;
	}
}
