<?php
namespace Decidir;

define('DECIDIR_VERSION','1.5.0');

class Connector {
	private $header_http = array();
	private $mode = NULL;
	private $healthCheck = NULL;
	private $paymentInstance = NULL;
	private $tokenInstance = NULL;
	private $developer = NULL;
    private $grouper = NULL;

	public function __construct($header_http_array, $mode, $developer = "Unknow Connector developer", $grouper = "Unknow Connector grouper"){

		$this->mode = $mode;
		$this->header_http = $header_http_array;
		$this->developer = $developer;
        $this->grouper = $grouper;

		$this->healthCheck = new \Decidir\HealthCheck($this->header_http, $this->mode);
		$this->paymentInstance = new \Decidir\Payment($this->header_http, $this->mode, $this->developer, $this->grouper);
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

	public function paymentToken(){
		return $this->tokenInstance;
	}
}
