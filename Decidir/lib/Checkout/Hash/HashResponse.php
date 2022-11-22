<?php
namespace Decidir\Checkout\Hash;

class PaymentResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}
}