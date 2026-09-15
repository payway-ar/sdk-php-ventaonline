<?php
namespace Decidir\TransactionHistory;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"chargeId" => array(
				"name" => "chargeId"
			),
		));

		$this->setOptionalFields(array());

		parent::__construct($data);
	}

	public function getData(){
		return $this->getDataField();
	}
}
