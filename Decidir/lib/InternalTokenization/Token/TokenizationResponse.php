<?php
namespace Decidir\InternalTokenization\Token;

class TokenizationResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}
}