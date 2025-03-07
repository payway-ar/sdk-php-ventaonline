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
			),
			"card_data" => array(
				"name" => array(
					"name" =>"card_holder_name"
				),
				"name" => array(
					"name" =>"last_four_digits"
				),
				"name" => array(
					"name" =>"card_holder_birthday"
				),
				"name" => array(
					"name" =>"card_holder_door_number"
				),
				"name" => array(
					"name" =>"card_holder_identification"
				),
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
			)
        ));

		parent::__construct($data);
	}

	public function getData(){
		return json_encode($this->getDataField());
	}
}

	
