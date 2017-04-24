<?php
namespace Decidir\DeleteRefund;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {
		parent::__construct($data);
	}

	public function getData(){
		return json_encode($this->getDataField());
	}
}