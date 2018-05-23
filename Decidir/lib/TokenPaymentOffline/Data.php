<?php
namespace Decidir\TokenPaymentOffline;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"name" => array(
				"name" => "name"
			),
			"type" => array(
				"name" => "type"
			),
			"number" => array(
				"name" => "number"
			)
		));

		parent::__construct($data);
	}

	public function getData(){
		$dataRequest = array();

		foreach($this->getDataField() as $index => $value){
			if($index == "name"){
				$dataRequest['customer'][$index] = $value;
			}else{

				$dataRequest['customer']['identification'][$index] = $value;
			}
		}
		return $array = json_encode($dataRequest);
	}
}

