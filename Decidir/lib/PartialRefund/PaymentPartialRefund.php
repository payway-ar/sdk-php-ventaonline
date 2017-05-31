<?php
namespace Decidir\PartialRefund;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class PaymentPartialRefund extends \Decidir\Data\AbstractData {
	protected $id;
	protected $amount;
	protected $sub_payments;
	protected $status;
	protected $error_type;
	protected $validation_errors;

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
			),
			"sub_payments" => array(
				"name" => "sub_payments"
			),
			"error_type" => array(
				"name" => "error_type"
			),
			"validation_errors" => array(
				"name" => "validation_errors"
			)
		));

		parent::__construct($data);
	}

	public function getId(){
		return $this->id;
	}

	public function getAmount(){
		return ($this->amount/100);
	}

	public function getSubPayments(){
		return $this->sub_payments;
	}

	public function getStatus(){
		return $this->status;
	}

	public function getErrorType(){
		return $this->error_type;
	}

	public function getValidationErrors(){
		return $this->validation_errors;
	}
}