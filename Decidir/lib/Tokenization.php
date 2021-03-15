<?php
namespace Decidir;

class Tokenization{
	public $mode = NULL;
	public $serviceREST = NULL;

	public function __construct($header_http, $mode){
		$this->header_http = $header_http;
		$this->mode = $mode;
		$this->serviceREST = new \Decidir\RESTClient($this->header_http, $this->mode);
	}	

	public function tokensList($data, $userId){
		if(empty($userId)){
			throw new \Exception("Empty User id");
		}

		$jsonData = new \Decidir\TokenCardsList\Data($data);
		$RESTResponse = $this->serviceREST->get("usersite/".$userId."/cardtokens", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\TokenCardsList\TokenCardsListResponse($ArrayResponse);
	}
	
	public function tokenCardDelete($data, $cardToken){
		if(empty($cardToken)){
			throw new \Exception("Empty Token");
		}

		$jsonData = new \Decidir\TokenCardDelete\Data($data);
		$RESTResponse = $this->serviceREST->delete("cardtokens/".$cardToken, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\TokenCardDelete\TokenCardDeleteResponse($ArrayResponse);
	}

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}
}
