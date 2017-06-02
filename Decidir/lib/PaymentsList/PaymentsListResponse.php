<?php
namespace Decidir\PaymentsList;

include_once dirname(__FILE__)."/../Data/Response.php";

class PaymentsListResponse extends \Decidir\Data\Response {
	protected $limit;
	protected $offset;
	protected $results = array();
	protected $hasMore;

	public function __construct(array $data) {
		parent::__construct($data);
	}

}
