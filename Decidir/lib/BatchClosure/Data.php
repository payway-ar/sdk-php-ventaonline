<?php
namespace Decidir\BatchClosure;

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"username" => array(
				"name" => "username"
			),
			"site_id" => array(
				"name" => "site_id"
			),
			"payment_method_id" => array(
				"name" => "payment_method_id"
			)));
		parent::__construct($data);
	}

	public function getData(){
		return $array = json_encode($this->getDataField());
	}
}