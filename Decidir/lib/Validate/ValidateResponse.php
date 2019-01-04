<?php
namespace Decidir\Validate;

include_once dirname(__FILE__)."/../Data/Response.php";

class ValidateResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}

}
