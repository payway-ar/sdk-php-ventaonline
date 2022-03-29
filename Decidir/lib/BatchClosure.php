<?php
namespace Decidir;
class BatchClosure{

    public $mode;
	public $serviceREST;
	public $keys_data = array();
	public $cybersource;
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

    public function batchClosure($data){
        $jsonData = new \Decidir\BatchClosure\Data($data);
		$RESTResponse = $this->serviceREST->post("closures/batchclosure", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\BatchClosure\BatchClosureResponse($ArrayResponse);
    }

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}

}