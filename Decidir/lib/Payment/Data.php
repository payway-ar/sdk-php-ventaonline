<?php
namespace Decidir\Payment;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
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
			"description" => array(
				"name" => "description"
			),
			"installments" => array(
				"name" => "installments"
			),
			"payment_type" => array(
				"name" => "payment_type"
			),
			"sub_payments" => array(
				"name" => "sub_payments"
			),
			"fraud_detection" => array(
				"name" => "fraud_detection"
			)
		));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}

