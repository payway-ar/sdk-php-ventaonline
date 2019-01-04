<?php
namespace Decidir\Exception;

class AllowValue extends \Decidir\Exception\SdkException {
	
	public function __construct($field) {
		$message = "Campo: " . $field . " no es requerido.";
		$code = null;//99977;
		parent::__construct($message, $code, $field);
	}
}



