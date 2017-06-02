<?php
namespace Decidir\PaymentInfo;

include_once dirname(__FILE__)."/../Data/Response.php";

class PaymentInfoResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}

}
