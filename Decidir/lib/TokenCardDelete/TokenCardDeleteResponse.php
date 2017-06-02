<?php
namespace Decidir\TokenCardDelete;

include_once dirname(__FILE__)."/../Data/Response.php";

class TokenCardDeleteResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}
}
