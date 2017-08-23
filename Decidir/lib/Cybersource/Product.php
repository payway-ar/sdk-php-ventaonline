<?php
namespace Decidir\Cybersource;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Product extends \Decidir\Data\AbstractData {
	protected $csitproductcode;
	protected $csitproductdescription;
	protected $csitproductname;
	protected $csitproductsku;
	protected $csittotalamount;
	protected $csitquantity;
	protected $csitunitprice;

	public function __construct($productData) {
		$this->setRequiredFields(array(
			"csitproductcode" => array(
				"name" => "code",
			),
			"csitproductdescription" => array(
				"name" => "description",
			),
			"csitproductname" => array(
				"name" => "name",
			),
			"csitproductsku" => array(
				"name" => "sku",
			),
			"csittotalamount" => array(
				"name" => "total_amount",
			),
			"csitquantity" => array(
				"name" => "quantity",
			),
			"csitunitprice" => array(
				"name" => "unit_price",
			),
		));

		parent::__construct($productData);

	}
	
	public function getProductcode() {
		return $this->csitproductcode;
	}

	public function setCode($csitproductcode) {
		$this->csitproductcode = $csitproductcode;
	}

	public function getProductdescription() {
		return $this->csitproductdescription;
	}

	public function setDescription($csitproductdescription) {
		$this->csitproductdescription = $csitproductdescription;
	}

	public function getProductname() {
		return $this->csitproductname;
	}

	public function setName($csitproductname) {
		$this->csitproductname = $csitproductname;
	}

	public function getProductsku() {
		return $this->csitproductsku;
	}

	public function setSku($csitproductsku) {
		$this->csitproductsku = $csitproductsku;
	}

	public function getTotalamount() {
		return $this->csittotalamount;
	}

	public function setTotalAmount($csittotalamount) {
		$this->csittotalamount = $csittotalamount;
	}

	public function getQuantity() {
		return $this->csitquantity;
	}

	public function setQuantity($csitquantity) {
		$this->csitquantity = $csitquantity;
	}

	public function getUnitprice() {
		return $this->csitunitprice;
	}

	public function setUnitPrice($csitunitprice) {
		$this->csitunitprice = $csitunitprice;
	}
}
