<?php
namespace Decidir\PartialRefund;

include_once dirname(__FILE__)."/../Data/Response.php";

class PaymentPartialRefund extends \Decidir\Data\Response {
	protected $id;
	protected $amount;
	protected $sub_payments;
	protected $status;
	protected $error_type;
	protected $validation_errors;

	public function __construct(array $data) {
		parent::__construct($data);
	}
}
