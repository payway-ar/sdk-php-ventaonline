<?php
namespace Decidir\InternalTokenization\Token;

class DataTokenization extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {


		$this->setRequiredFields(array(
            "card_data" => array(
                "name" => array(
                    "card_number" => array(
                        "name" => "card_number",
                    ),
                    "expiration_date" => array(
                        "name" => "expiration_date",
                    ),
                    "card_holder" => array(
                        "name" => "card_holder",
                    ),
                    "security_code" => array(
                        "name" => "security_code",
                    ),
                    "account_number" => array(
                        "name" => "account_number",
                    ),
                    "email_holder" => array(
                        "name" => "email_holder"
                    ),
                )
                ),
                "establishment_number" => array(
                    "name" => "establishment_number"
                ),
		));

        

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}