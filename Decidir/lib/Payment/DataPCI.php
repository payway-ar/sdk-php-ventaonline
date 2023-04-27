<?php
namespace Decidir\Payment;

class DataPCI extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

        $this->setOptionalFields(array(
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
			"establishment_name" => array(
				"name" => ""
			),
			"card_data" => array(
				"name" => ""
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
			"spv" => array(
                "name" => "spv"
            ),
			"user_id" => array(
                "name" => "user_id"
            ),
            "description" => array(
                "name" => "description"
            ),
            "fraud_detection" => array(
				"name" => "fraud_detection"
			),
			"cardholder_auth_required" => array(
				"name" => "cardholder_auth_required"
			),
			"auth_3ds_data" => array(
				"name" => array(
					"device_type" => array(
						"name" => ""
					),
					"accept_header" => array(
						"name" => "accept_header"
					),
					"user_agent" => array(
						"name" => "user_agent"
					),
					"ip" => array(
						"name" => "ip"
					),
					"java_enabled" => array(
						"name" => "java_enabled"
					),
					"language" => array(
						"name" => "language"
					),
					"color_depth" => array(
						"name" => "color_depth"
					),
					"screen_height" => array(
						"name" => "screen_height"
					),
					"screen_width" => array(
						"name" => "screen_width"
					),
					"time_zone_offset" => array(
						"name" => "device_type"
					),
				)
			)

        ));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}

	