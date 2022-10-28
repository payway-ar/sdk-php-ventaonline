<?php
namespace Decidir\Threeds;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"id" => array(
				"name" => "id"
			),
			"challenge_value" => array(
				"name" => "challenge_value"
			),
		));

		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}