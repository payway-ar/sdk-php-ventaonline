<?php
namespace Decidir\PaymentOffline;

class DataPMC extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"site_transaction_id" => array(
				"name" => "site_transaction_id"
			),
			"token" => array(
				"name" => "token"
			),
			"payment_method_id" => array(
				"name" => "payment_method_id"
			),
			"amount" => array(
				"name" => "amount"
			),
			"currency" => array(
				"name" => "currency"
			),
			"email" => array(
				"name" => "email"
			),
			"invoice_expiration" => array(
				"name" => "invoice_expiration"
			),
			"payment_type" => array(
				"name" => "payment_type"
			),
			"sub_payments" => array(
				"name" => "sub_payments"
			),
			"bank_id" => array(
				"name" => "bank_id"
			)
		));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}

