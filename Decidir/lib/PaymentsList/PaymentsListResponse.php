<?php
namespace Decidir\PaymentsList;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class PaymentsListResponse extends \Decidir\Data\AbstractData {
	protected $limit;
	protected $offset;
	protected $results = array();
	protected $hasMore;

	public function __construct(array $data) {
		$this->setRequiredFields(array(
			"limit" => array(
				"name" => "limit"
			),
			"offset" => array(
				"name" => "offset"
			),
			"results" => array(
				"name" => "results"
			),
			"hasMore" => array(
				"name" => "hasMore"
			)
		));

		parent::__construct($data);
	}

	public function getLimit(){
		return $this->limit;
	}

	public function getOffset(){
		return $this->offset;
	}

	public function getResults(){
		return $this->results;
	}

	public function getHasMore(){
		return $this->hasMore;
	}
}