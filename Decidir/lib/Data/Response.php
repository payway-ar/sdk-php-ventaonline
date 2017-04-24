<?php
namespace Decidir\Data;

include_once dirname(__FILE__)."/AbstractData.php";

class ResponsePayment extends \Decidir\Data\AbstractData {


	protected $dataResponse = array();

	public function __construct(array $data) {
		$this->dataResponse = $data;

		parent::__construct($data);

	}

	public function getDataResponse(){
		return $this->$dataResponse();
	}
}