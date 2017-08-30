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

		if(!empty($data["sub_payments"])) {
			foreach($data["sub_payments"] as $k => $d) {
				$damount = $this->rmDecAmount($d["amount"]);
				$data["sub_payments"][$k]["amount"] = $amount;
                        }
                }

		$jsonData = new \Decidir\Payment\Data($data);
		$RESTResponse = $this->serviceREST->post("payments", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Payment\PaymentResponse($ArrayResponse);
	}

	public function CapturePayment($operationId, $data){
		$data['amount'] = $this->rmDecAmount($data['amount']);

		$RESTResponse = $this->serviceREST->put("payments/".$operationId, json_encode($data));
                $ArrayResponse = $this->toArray($RESTResponse);
                return new \Decidir\PaymentInfo\PaymentInfoResponse($ArrayResponse);
	}

	public function PaymentList($data){
		$jsonData = new \Decidir\PaymentsList\Data($data);
		$RESTResponse = $this->serviceREST->get("payments", array(), $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\PaymentsList\PaymentsListResponse($ArrayResponse);
	}

	public function PaymentInfo($data, $operationId){
		if(empty($operationId)){
			throw new \Exception("Empty Operation id");
		}

		$jsonData = new \Decidir\PaymentInfo\Data($data);
		$RESTResponse = $this->serviceREST->get("payments/".$operationId, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\PaymentInfo\PaymentInfoResponse($ArrayResponse);
	}

	public function Refund($data, $operationId){
		if(empty($operationId)){
			throw new \Exception("Empty Operation id");
		}

		$jsonData = new \Decidir\Refund\Data($data);
		$RESTResponse = $this->serviceREST->post("payments/".$operationId."/refunds", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Refund\PaymentRefundResponse($ArrayResponse);
	}

	public function deleteRefund($data, $operationId, $refundId){
		if(empty($operationId)){
			throw new \Exception("Empty Operation id");
		}

		if(empty($refundId)){
			throw new \Exception("Empty Refund id");
		}

		$jsonData = new \Decidir\DeleteRefund\Data($data);
		$RESTResponse = $this->serviceREST->delete("payments/".$operationId."/refunds/".$refundId, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\DeleteRefund\PaymentDeleteRefundResponse($ArrayResponse);
	}

	public function partialRefund($data, $operationId){
		if(empty($operationId)){
			throw new \Exception("Empty Operation id");
		}

		$data['amount'] = $this->rmDecAmount($data['amount']);
		$jsonData = new \Decidir\PartialRefund\Data($data);

		$RESTResponse = $this->serviceREST->post("payments/".$operationId."/refunds", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);

		return new \Decidir\PartialRefund\PaymentPartialRefund($ArrayResponse);
	}

	public function deletePartialRefund($data, $operationId, $refundId){
		if(empty($operationId)){
			throw new \Exception("Empty Operation id");
		}

		if(empty($refundId)){
			throw new \Exception("Empty Refund id");
		}

		$jsonData = new \Decidir\DeleteRefund\Data($data);
		return $this->serviceREST->delete("payments/".$operationId."/refunds/".$refundId, $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);

		return new \Decidir\DeleteRefund\PaymentDeleteRefund($ArrayResponse);
	}

	public function setCybersource($data){
		$data['purchase_totals']['amount']= $this->rmDecAmount($data['purchase_totals']['amount']);
		$this->cybersource = $data;
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

