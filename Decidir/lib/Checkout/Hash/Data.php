<?php
namespace Decidir\Checkout\Hash;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"id" => array(
				"name" => ""
			),
			"site" => array(
				"name" => ""
			),
            "total_price" => array(
                "name"=> ""
            ),
            "life_time"=> array(
                "name"=> ""
            ),
            "template_id"=> array(
                "name"=> ""
            ),

		));

        $this->setOptionalFields(array(
            "cancel_url" => array(
                "name" => ""
            ),
            "products"=> array(
                "name" => array(
                    "id"=> array(
                        "name" => ""
                    ),
                    "volume"=> array(
                        "name" => ""
                    ),
                    "weight"=> array(
                        "name" => ""
                    ),
                    "value"=> array(
                        "name" => ""
                    ),
                    "description"=> array(
                        "name" => ""
                    ),
                    "category_id"=> array(
                        "name" => ""
                    ),
                    "quantity"=> array(
                        "name" => ""
                    ),
                )
            ),
            "notifications_url" => array(
                "name" => ""
            ),
            "success_url" => array(
                "name" => ""
            ),
			"redirect_url" => array(
                "name" => ""
            ),
			"cancel_url" => array(
                "name" => ""
            ),
            "type_plan_ahora" => array(
                "name" => ""
            ),
            "installments" => array(
                "name" => array()
            ),
            "origin_platform" => array(
                "name" => ""
            )
            
        ));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}