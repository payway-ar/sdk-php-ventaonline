<?php
namespace Decidir\TokenCardDelete;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class TokenCardDeleteResponse extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {
		$this->setRequiredFields(array());

		parent::__construct($data);
	}
}