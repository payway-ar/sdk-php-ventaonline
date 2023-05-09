<?php
namespace Decidir;

class InternalTokenization{
	public $mode;
	public $serviceREST;
	public $keys_data = array();
	public $developer=NULL;
    public $grouper=NULL;
    public $service = NULL;

	public function __construct($keys_data, $mode, $developer, $grouper, $service){
		$this->keys_data = $keys_data;
		$this->mode = $mode;
		$this->developer = $developer;
		$this->grouper = $grouper;
		$this->service = $service;
		$this->serviceREST = new \Decidir\RESTClient($this->keys_data, $this->mode, $developer, $grouper, $service);
	}

	public function token($data){
		$jsonData = new \Decidir\InternalTokenization\Token\DataTokenization($data);
		$RESTResponse = $this->serviceREST->post("transaction_gateway/tokens", array(), $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\InternalTokenization\Token\TokenizationResponse($ArrayResponse);
	}

    public function cryptogram($data){
		$jsonData = new \Decidir\InternalTokenization\Cryptogram\DataCryptogram($data);
		$RESTResponse = $this->serviceREST->post("transaction_gateway/payments", array(), $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\InternalTokenization\Cryptogram\CryptogramResponse($ArrayResponse);
	}

    

	

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}
}
