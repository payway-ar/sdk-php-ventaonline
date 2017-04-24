<?php
namespace Decidir\Refund;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class PaymentRefundResponse extends \Decidir\Data\AbstractData {
	protected $id;
	protected $amount;
	protected $sub_payments;
	protected $status;
	public function __construct(array $data) {
		$this->setRequiredFields(array(
			"id" => array(
				"name" => "id"
			),
			"amount" => array(
				"name" => "amount"
			),
			"sub_payments" => array(
				"name" => "sub_payments"
			),
			"status" => array(
				"name" => "status"
			)
		));

		parent::__construct($data);
	}

	public function getId(){
		return $this->id;
	}

	public function getAmount(){
		return $this->amount;
	}

	public function getSubPayments(){
		return $this->sub_payments;
	}

	public function getStatus(){
		return $this->status;
	}
}