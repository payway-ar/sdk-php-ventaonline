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
			"customer" => array(
				"name" => "customer"
			),
			"site_id" => array(
				"name" => ""
			),
		));

        $this->setOptionalFields(array(
            "user_id" => array(
                "name" => "user_id"
            ),
            "description" => array(
                "name" => "description"
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

