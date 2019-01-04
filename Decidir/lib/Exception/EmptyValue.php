<?php
namespace Decidir\Exception;

class EmptyValue extends \Decidir\Exception\SdkException {
	
	public function __construct($field) {
		$message = "Campo: " . $field . " no puede estar vacio.";
		$code = null;//99977;
		parent::__construct($message, $code, $field);
	}
}



