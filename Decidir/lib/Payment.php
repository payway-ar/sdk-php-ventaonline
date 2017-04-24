<?php
namespace Decidir;

class Payment{
	public $mode;
	public $serviceREST;
	public $keys_data = array();
	public $cybersource;

	public function __construct($keys_data, $mode){
		$this->keys_data = $keys_data;
		$this->mode = $mode;

		$this->serviceREST = new \Decidir\RESTClient($this->keys_data, $this->mode);
	}	

	public function ExecutePayment($data){
		$data['amount'] = $this->rmDecAmount($data['amount']);	
		
		if(!empty($this->cybersource) && $this->cybersource['send_to_cs'] == true){
			$data['fraud_detection'] = json_decode(json_encode($this->cybersource),TRUE);
		}

		$jsonData = new \Decidir\Payment\Data($data);	
		$RESTResponse = $this->serviceREST->post("payments", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Payment\PaymentResponse($ArrayResponse);
	}

	public function PaymentList($data){
		$jsonData = new \Decidir\PaymentsList\Data($data);
		$RESTResponse = $this->serviceREST->get("payments", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\PaymentsList\PaymentsListResponse($ArrayResponse);
	}

	public function PaymentInfo($data, $operationId){
		$jsonData = new \Decidir\PaymentInfo\Data($data);
		$RESTResponse = $this->serviceREST->get("payments/".$operationId, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\PaymentInfo\PaymentInfoResponse($ArrayResponse);
	}

	public function Refund($data, $operationId){
		$jsonData = new \Decidir\Refund\Data($data);
		$RESTResponse = $this->serviceREST->post("payments/".$operationId."/refunds", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Refund\PaymentRefundResponse($ArrayResponse);
	}

	public function deleteRefund($data, $operationId, $refundId){
		$jsonData = new \Decidir\DeleteRefund\Data($data);
		$RESTResponse = $this->serviceREST->delete("payments/".$operationId."/refunds/".$refundId, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\DeleteRefund\PaymentDeleteRefundResponse($ArrayResponse);
	}

	public function partialRefund($data, $operationId){
		$data['amount'] = $this->rmDecAmount($data['amount']);
		$jsonData = new \Decidir\PartialRefund\Data($data);
		$RESTResponse = $this->serviceREST->post("payments/".$operationId."/refunds", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);

		return new \Decidir\PartialRefund\PaymentPartialRefund($ArrayResponse);
	}

	public function deletePartialRefund($data, $operationId, $refundId){
		$jsonData = new \Decidir\DeleteRefund\Data($data);
		return $this->serviceREST->delete("payments/".$operationId."/refunds/".$refundId, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);

		return new \Decidir\DeleteRefund\PaymentDeleteRefund($ArrayResponse);
	}

	public function setCybersource($data){
		$this->cybersource = $data;
	}

	public function toDecimalAmount($amount){
		$decimalFomatAMount = ($amount/100);

		return $decimalFomatAMount;
	}

	public function rmDecAmount($amount){

		$formatedAmount = ($amount*100);	

		return $formatedAmount;
	}

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}

}

