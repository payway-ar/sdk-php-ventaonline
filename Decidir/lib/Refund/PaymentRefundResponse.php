<?php
namespace Decidir\Refund;

include_once dirname(__FILE__)."/../Data/Response.php";

class PaymentRefundResponse extends \Decidir\Data\Response {
	public function __construct(array $data) {
		parent::__construct($data);
	}
}
