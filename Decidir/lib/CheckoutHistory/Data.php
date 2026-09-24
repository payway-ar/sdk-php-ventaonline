<?php
namespace Decidir\CheckoutHistory;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Data extends \Decidir\Data\AbstractData {

	public function __construct(array $data) {

		$this->setRequiredFields(array(
			"platform" => array(
				"name" => "platform"
			),
		));

		$this->setOptionalFields(array(
			"page" => array(
				"name" => "page"
			),
			"items_per_page" => array(
				"name" => "items_per_page"
			),
			"site_id" => array(
				"name" => "site_id"
			),
			"operation_id" => array(
				"name" => "operation_id"
			),
			"establishment_number" => array(
				"name" => "establishment_number"
			),
			"status" => array(
				"name" => "status"
			),
			"from_date" => array(
				"name" => "from_date"
			),
			"to_date" => array(
				"name" => "to_date"
			),
			"description" => array(
				"name" => "description"
			),
			"cuit" => array(
				"name" => "cuit"
			),
			"currency" => array(
				"name" => "currency"
			),
			"max_amount" => array(
				"name" => "max_amount"
			),
			"min_amount" => array(
				"name" => "min_amount"
			),
			"installments" => array(
				"name" => "installments"
			),
			"payment_method_id" => array(
				"name" => "payment_method_id"
			),
		));

		parent::__construct($data);
	}

	public function getData(){
		return $this->getDataField();
	}
}
