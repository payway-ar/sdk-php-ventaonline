<?php
namespace Decidir;

define('DECIDIR_VERSION','1.5.0');

class Connector {
	private $header_http = array();
	private $mode = NULL;
	private $healthCheck = NULL;
	private $paymentInstance = NULL;
	private $tokenInstance = NULL;
	private $paymentTokenInstance = NULL;
	private $batchClosureInstance = NULL;
	private $threedsChallengeInstance = NULL;
	private $developer = NULL;
    private $grouper = NULL;
    private $service = NULL;

	public function __construct($header_http_array, $mode, $developer = "", $grouper = "", $service = "SDK-PHP"){

		$this->mode = $mode;
		$this->header_http = $header_http_array;
		$this->developer = $developer;
        $this->grouper = $grouper;
        $this->service = $service;

		$this->healthCheck = new \Decidir\HealthCheck($this->header_http, $this->mode);
		$this->paymentInstance = new \Decidir\Payment($this->header_http, $this->mode, $this->developer, $this->grouper, $this->service);
		$this->tokenInstance = new \Decidir\Tokenization($this->header_http, $this->mode);
		$this->paymentTokenInstance = new \Decidir\Token($this->header_http, $this->mode, $this->developer, $this->grouper, $this->service);
		$this->batchClosureInstance = new \Decidir\BatchClosure($this->header_http, $this->mode, $this->developer, $this->grouper, $this->service);
		$this->threedsChallengeInstance = new \Decidir\ThreedsChallenge($this->header_http, $this->mode, $this->developer, $this->grouper, $this->service);
	}

	public function healthcheck(){
		return $this->healthCheck;
	}

	public function token(){
		return $this->paymentTokenInstance;
	}

	public function tokenCs(){
		return $this->paymentTokenInstance;
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

	public function batchClosure(){
		return $this->batchClosureInstance;
	}

	public function threedsChallenge(){
		return $this->threedsChallengeInstance;
	}
}
