<?php
namespace Decidir\Payment;

class DataPCI extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

        $this->setOptionalFields(array(
			"site_transaction_id" => array(
				"name" => "site_transaction_id"
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
			"card_data" => array(
				"name" => ""
			),
            "site_id" => array(
                "name" => "site_id"
            ),
            "is_tokenized_payment" => array(
				"name" => "is_tokenized_payment"
			),
			"token_card_data" => array(
				"name" => array(
					"name" =>"token"
				),
				"name" => array(
					"name" =>"eci"
				),
				"name" => array(
					"name" =>"cryptogram"
				),
			),
			"establishment_name" => array(
                "name" => "establishment_name"
            ),
			"spv" => array(
                "name" => "spv"
            ),
			"bin" => array(
                "name" => "bin"
            ),
			"fraud_detection" => array(
				"name" => ""
			),
			"aggregate_data" => array(
				"name" => ""
			),
			"description" => array(
				"name" => "description"
			),
			"cardholder_auth_required" => array(
				"name" => "cardholder_auth_required"
			),

        ));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}

	