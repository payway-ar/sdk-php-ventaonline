<?php
namespace Decidir\TokenPaymentOffline;

include_once dirname(__FILE__)."/../Data/Response.php";

class TokenPaymentOfflineResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}
}
