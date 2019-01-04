<?php
namespace Decidir\Validate;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"id" => array(
				"name" => ""
			),
			"site" => array(
				"name" => "site"
			),
			"customer" => array(
				"name" => "customer"
			),
			"payment" => array(
				"name" => "payment"
			),
			"template" => array(
				"name" => ""
			),
			"transaction_id" => array(
				"name" => "transaction_id"
			),
			"amount" => array(
				"name" => "amount"
			),
			"email" => array(
				"name" => ""
			),
			"currency" => array(
				"name" => "currency"
			),
			"payment_method_id" => array(
				"name" => "payment_method_id"
			),
			"bin" => array(
				"name" => ""
			),
			"installments" => array(
				"name" => "installments"
			),
			"payment_type" => array(
				"name" => "payment_type"
			),
			"success_url" => array(
				"name" => ""
			),
			"cancel_url" => array(
				"name" => ""
			),
			"redirect_url" => array(
				"name" => ""
			),
			"fraud_detection" => array(
				"name" => ""
			)
		));

		parent::__construct($data);
	}

	public function getData(){
		return json_encode($this->getDataField());
	}
}