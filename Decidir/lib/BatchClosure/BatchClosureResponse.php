<?php
namespace Decidir\BatchClosure;

class BatchClosureResponse extends \Decidir\Data\Response {

	public function __construct(array $data) {
		parent::__construct($data);
	}
}