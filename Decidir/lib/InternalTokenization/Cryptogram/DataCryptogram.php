<?php
namespace Decidir\InternalTokenization\Cryptogram;

class DataCryptogram extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setOptionalsFields(array(
			"store_credential" => array(
                "name" => "store_credentials"
            ),
            "merchant_id" => array(
                "name" => "merchant_id"
            ),
            "transaction_data" => array(
                "name" => array(
                    "merchant_transaction_id" => array(
                        "name" => "merchant_transaction_id"
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
                    "sub_payments" => array( 
                        "name" => "sub_payments"
                    ),
                    "description" => array(
                        "name" => "description"
                    ),
                )),
                "customer_data" => array(
                    "name" => array(
                        "token_id" => array(
                            "name" => "token_id"
                        ),
                        "identification_type" => array(
                            "name" => "identification_type"
                        ),
                        "identification_number" => array(
                            "name" => "identification_number"
                        )
                )),      
		));

        

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}