<?php
namespace Decidir\DeleteRefund;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class PaymentDeleteRefundResponse extends \Decidir\Data\AbstractData {
	protected $amount;
	protected $status;

	public function __construct(array $data) {
		$this->setRequiredFields(array(
			"amount" => array(
				"name" => "amount"
			),
			"status" => array(
				"name" => "status"
			)
		));

		parent::__construct($data);
	}

	public function getAmount(){
		return $this->amount;
	}

	public function getstatus(){
		return $this->status;
	}
}