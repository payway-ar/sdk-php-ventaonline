<?php
namespace Decidir\DeleteRefund;

include_once dirname(__FILE__)."/../Data/Response.php";

class PaymentDeleteRefundResponse extends \Decidir\Data\Response {
	protected $amount;
	protected $status;
	protected $error_type;
	protected $validation_errors;

	public function __construct(array $data) {
		parent::__construct($data);
	}
}
