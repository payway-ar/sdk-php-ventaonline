<?php
namespace Decidir\CheckoutHistory;

include_once dirname(__FILE__)."/../Data/Response.php";

class CheckoutHistoryResponse extends \Decidir\Data\Response {
	protected $history = array();
	protected $count;
	protected $page;
	protected $totalItems;

	public function __construct(array $data) {
		parent::__construct($data);
	}
}
