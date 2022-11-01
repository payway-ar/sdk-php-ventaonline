<?php
namespace Decidir;
class ThreedsChallenge{

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

    public function theedsChallenge($data){
        $jsonData = new \Decidir\Threeds\Data($data);
		$RESTResponse = $this->serviceREST->post("threeds/instruction", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Threeds\ThreedsResponse($ArrayResponse);
    }

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}

}