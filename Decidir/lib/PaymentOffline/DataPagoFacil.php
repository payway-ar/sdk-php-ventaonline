<?php
namespace Decidir\PaymentOffline;

class DataPagoFacil extends \Decidir\Data\AbstractData {

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
			"payment_type" => array(
				"name" => "payment_type"
			),
			"email" => array(
				"name" => "email"
			),
			"invoice_expiration" => array(
				"name" => "invoice_expiration"
			),
			"cod_p3" => array(
				"name" => "cod_p3"
			),
			"cod_p4" => array(
				"name" => "cod_p4"
			),
			"client" => array(
				"name" => "client"
			),
			"surcharge" => array(
				"name" => "surcharge"
			),
			"payment_mode" => array(
				"name" => "payment_mode"
			)
		));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}

