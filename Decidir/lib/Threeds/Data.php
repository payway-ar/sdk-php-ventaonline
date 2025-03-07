<?php
namespace Decidir\Threeds;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"id" => array(
				"name" => "id"
			),
			"instruction_value" => array(
				"name" => "instruction_value"
			),
		));

		parent::__construct($data);
	}

	public function getData(){
		return json_encode($this->getDataField());
	}
}
