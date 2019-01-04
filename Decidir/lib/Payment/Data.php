<?php
namespace Decidir\Payment;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"id" => array(
				"name" => ""
			),
			"email" => array(
				"name" => "email"
			),
			"ip_address" => array(
				"name" => "ip_address"
			),
			"site_transaction_id" => array(
				"name" => "site_transaction_id"
			),
			"token" => array(
				"name" => "token"
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
			"establishment_name" => array(
				"name" => ""
			),
			"sub_payments" => array(
				"name" => ""
			),
			"aggregate_data" => array(
				"name" => ""
			),
			"fraud_detection" => array(
				"name" => "fraud_detection"
			),
			"customer" => array(
				"name" => "customer"
			),
			"site_id" => array(
				"name" => ""
			),
		));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}

