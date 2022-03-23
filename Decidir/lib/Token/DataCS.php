<?php
namespace Decidir\Token;

class DataCS extends \Decidir\Token\Data{

    public function __construct(array $data) {

		$this->setRequiredFields(array(
			"fraud_detection" => array(
				"name" => array(
                    "device_unique_identifier" => array(
                        "name"=> "device_unique_identifier"
                    )
                )
			),
		));

        $this->setOptionalFields(array(
            "ip_address" => array(
                "name" => "ip_address"
            )
        ));
		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}