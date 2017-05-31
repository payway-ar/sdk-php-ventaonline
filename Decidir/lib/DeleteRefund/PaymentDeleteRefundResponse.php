<?php
namespace Decidir\DeleteRefund;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class PaymentDeleteRefundResponse extends \Decidir\Data\AbstractData {
	protected $amount;
	protected $status;
	protected $error_type;
	protected $validation_errors;

	public function __construct(array $data) {
		$this->setRequiredFields(array(
			"amount" => array(
				"name" => "amount"
			),
			"status" => array(
				"name" => "status"
			),
			"error_type" => array(
				"name" => "error_type"
			),
			"validation_errors" => array(
				"name" => "validation_errors"
			),
			"sub_payments" => array(
				"name" => "sub_payments"
			),
			"validation_errors" => array(
				"name" => "validation_errors"
			)
		));

		parent::__construct($data);
	}

	public function getAmount(){
		return $this->amount;
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