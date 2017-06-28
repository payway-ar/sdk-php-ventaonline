<?php
namespace Decidir\PaymentsList;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {
		$this->setRequiredFields(array());
		parent::__construct($data);
	}

	public function getData(){
		return $this->getDataField();
	}
}
