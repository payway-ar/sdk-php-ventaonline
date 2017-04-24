<?php
namespace Decidir\Payment;

class PaymentResponse extends \Decidir\Data\AbstractData {
	protected $id;
	protected $site_transaction_id;
	protected $token;
	protected $user_id;
	protected $payment_method_id;
	protected $card_brand;
	protected $bin;
	protected $amount;
	protected $currency;
	protected $installments;
	protected $payment_type;
	protected $sub_payments = array();
	protected $status;
	protected $status_details;
	protected $date;
	protected $merchant_id;
	protected $establishment_name;
	protected $fraud_detection = array();
	protected $aggregate_data;
	protected $message;

	public function __construct(array $data) {
		$this->setRequiredFields(array(
			"id" => array(
				"name" => "id"
			),
			"site_transaction_id" => array(
				"name" => "site_transaction_id"
			),
			"token" => array(
				"name" => "token"
			),
			"user_id" => array(
				"name" => "user_id"
			), 
			"payment_method_id" => array(
				"name" => "payment_method_id"
			),
			"bin" => array(
				"name" => "bin"
			),
			"amount" => array(
				"name" => "amount"
			),
			"currency" => array(
				"name" => "currency"
			),
			"installments" => array(
				"name" => "installments"
			),
			"description" => array(
				"name" => "description"
			),
			"payment_type" => array(
				"name" => "payment_type"
			),
			"sub_payments" => array(
				"name" => "sub_payments"
			),
			"status" => array(
				"name" => "status"
			),
			"status" => array(
				"name" => "status"
			),
			"status_details" => array(
				"name" => "status_details"
			),
			"date" => array(
				"name" => "date"
			),
			"merchant_id" => array(
				"name" => "merchant_id"
			),
			"establishment_name" => array(
				"name" => "establishment_name"
			),
			"fraud_detection" => array(
				"name" => "fraud_detection"
			),
			"aggregate_data" => array(
				"name" => "aggregate_data"
			),
			"message" => array(
				"name" => "message"
			)		
		));

		parent::__construct($data);
	}

	public function getSiteTransactionId(){
		return $this->site_transaction_id;
	}

	public function getId(){
		return $this->id;
	}

	public function getToken(){
		return $this->token;
	}

	public function getUserId(){
		return $this->user_id;
	}

	public function getpaymentMethodId(){
		return $this->payment_method_id;
	}

	public function getCardBrand(){
		return $this->card_brand;
	}

	public function getBin(){
		return $this->bin;
	}

	public function getAmount(){
		return $decimalFomatAMount = ($this->amount/100);
	}

	public function getCurrency(){
		return $this->currency;
	}

	public function getInstallments(){
		return $this->installments;
	}

	public function getDescription(){
		return $this->description;
	}	

	public function getPaymentType(){
		return $this->payment_type;
	}	

	public function getDateDue(){
		return $this->dateCreated;
	}	

	public function getSubPayments(){
		return $this->sub_payments;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getStatusDetails(){
		return $this->status_details;
	}

	public function getDate(){
		return $this->date;
	}

	public function getMerchantId(){
		return $this->merchant_id;
	}

	public function getEstablishmentName(){
		return $this->status;
	}	

	public function getFraudDetection(){
		return $this->fraud_detection;
	}

	public function getAggregateData(){
		return $this->aggregate_data;
	}
	
	public function getMessage(){
		return $this->message;
	}	
}