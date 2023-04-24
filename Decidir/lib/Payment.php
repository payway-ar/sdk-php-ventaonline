<?php
namespace Decidir;

class Payment{
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

	public function ExecutePayment($data){
		// $data['amount'] = $data['amount'];
		$data3ds = array();
		$tokenCardData = array();

		if(!empty($this->cybersource) && $this->cybersource['send_to_cs'] == true){
			$data['fraud_detection'] = json_decode(json_encode($this->cybersource),TRUE);
		}

		if(!empty($data["sub_payments"])) {
			foreach($data["sub_payments"] as $k => $d) {
				$damount = $d["amount"];
				$data["sub_payments"][$k]["amount"] = $damount;
            }
        }

		if (!empty($data["is_tokenized_payment"]) && $data["is_tokenized_payment"] == true){
			$tokenCardData["token"] = $data["token_card_data"]["token"];
			$tokenCardData["eci"] = $data["token_card_data"]["eci"];
			$tokenCardData["cryptogram"] = $data["token_card_data"]["cryptogram"];
			$data["token_card_data"] = $tokenCardData;
		}
		
		if (array_key_exists("cardholder_auth_required", $data) && !empty($data["cardholder_auth_required"]) && $data["cardholder_auth_required"] == true){
			$data3ds["device_type"] = $data["auth_3ds_data"]["device_type"];
			$data3ds["accept_header"] = $data["auth_3ds_data"]["accept_header"];
			$data3ds["user_agent"] = $data["auth_3ds_data"]["user_agent"];
			$data3ds["ip"] = $data["auth_3ds_data"]["ip"];
			$data3ds["java_enabled"] = $data["auth_3ds_data"]["java_enabled"];
			$data3ds["language"] = $data["auth_3ds_data"]["language"];
			$data3ds["color_depth"] = $data["auth_3ds_data"]["color_depth"];
			$data3ds["screen_height"] = $data["auth_3ds_data"]["screen_height"];
			$data3ds["screen_width"] = $data["auth_3ds_data"]["screen_width"];
			$data3ds["time_zone_offset"] = $data["auth_3ds_data"]["time_zone_offset"];
			$data["auth_3ds_data"] = $data3ds;
		}

		if (array_key_exists("card_data", $data)){
			$jsonData = new \Decidir\Payment\DataPCI($data);
		} else {
			$jsonData = new \Decidir\Payment\Data($data);
		}
		$RESTResponse = $this->serviceREST->post("payments", $jsonData->getData());
		// $RESTResponse = $this->serviceREST->post("payments", json_encode($data));
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Payment\PaymentResponse($ArrayResponse);
	}

	public function ExecutePaymentOffline($data){
		$data['amount'] = $data['amount'];

		if(!empty($data['surcharge'])){
			$data['surcharge'] = $data['surcharge'];
		}
		
		if($data['payment_method_id'] == 25){
			$jsonData = new \Decidir\PaymentOffline\DataPagoFacil($data);

		}elseif($data['payment_method_id'] == 26){
			$jsonData = new \Decidir\PaymentOffline\DataRapipago($data);

		}elseif($data['payment_method_id'] == 41){
			$jsonData = new \Decidir\PaymentOffline\DataPMC($data);

		}elseif($data['payment_method_id'] == 48){
			$jsonData = new \Decidir\PaymentOffline\DataCajaPagos($data);

		}elseif($data['payment_method_id'] == 51){	
			$jsonData = new \Decidir\PaymentOffline\DataCobroExp($data);
		}

		$RESTResponse = $this->serviceREST->post("payments", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\PaymentOffline\PaymentOfflineResponse($ArrayResponse);
	}

	public function CapturePayment($operationId, $data){
		$data['amount'] = $data['amount'];

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

	public function PaymentInfo($data, $operationId, $query = array()){
		if(empty($operationId)){
			throw new \Exception("Empty Operation id");
		}

		$jsonData = new \Decidir\PaymentInfo\Data($data);
		$RESTResponse = $this->serviceREST->get("payments/".$operationId, $jsonData->getData(), $query);
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\PaymentInfo\PaymentInfoResponse($ArrayResponse);
	}

	public function Validate($data){
		$data['payment']['amount'] = $data['payment']['amount'];

		if(!empty($this->cybersource) && $this->cybersource['send_to_cs'] == true){
			$data['fraud_detection'] = json_decode(json_encode($this->cybersource),TRUE);
		}

		$jsonData = new \Decidir\Validate\Data($data);	
		$RESTResponse = $this->serviceREST->post("validate", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Validate\ValidateResponse($ArrayResponse);
	}

	public function GenerateLink($data){
		$jsonData = new \Decidir\Checkout\Hash\Data($data);
		$data['origin_platform'] = "SDK-PHP";
		$RESTResponse = $this->serviceREST->post("orchestrator/checkout/payments/link", $jsonData->getData());
		$ArrayResponse = $this->toArray($RESTResponse);
		return new \Decidir\Checkout\Hash\HashResponse($ArrayResponse);
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
		$data['purchase_totals']['amount']=$data['purchase_totals']['amount'];
		$this->cybersource = $data;
	}

	public function rmDecAmount($amount){
		$formatedAmount = $amount*100;	

		return $formatedAmount;
	}

	public function toArray($jsonResponse){
		$ResponseValues = json_decode(json_encode($jsonResponse),TRUE);

		return $ResponseValues;
	}
}

