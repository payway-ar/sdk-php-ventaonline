<?php
namespace Decidir\Cybersource;

include_once dirname(__FILE__)."/AbstractData.php";
include_once dirname(__FILE__)."/Product.php";

class DigitalGoods extends AbstractData
{
	protected $send_to_cs;
	protected $channel;
	protected $dataSet = array();
	protected $products_data = null;

	public function __construct($retailData, $productsData) {

		$this->setRequiredFields(array(	
			"send_to_cs" => array(
				"name" => "setChannel"
			),
			"channel" => array(
				"name" => "setSendToCs"
			),
			"bill_to" => array(
				"name" => "setBillTo"
			),
			"currency" => array(
				"name" => "setCurrency"
			),
			"amount" => array(
				"name" => "setAmount"
			),
			"days_in_site" => array(
				"name" => "setDaysInSite"
			),
			"is_guest" => array(
				"name" => "setIsGuest"
			),
			"password" => array(
				"name" => "setPassword"
			),
			"num_of_transactions" => array(
				"name" => "setNumOfTransactions"
			),
			"cellphone_number" => array(
				"name" => "setCellPhoneNumber"
			),
			"date_of_birth" => array(
				"name" => "setDateOfBirth"
			),
			"street" => array(
				"name" => "setStreet"
			),
			"delivery_type" => array(
				"name" => "setDeliveryType"
			)
		));		
		
		parent::__construct($retailData);

		foreach($productsData as $index => $product) {
			foreach($product as $idProd => $value){
				if($idProd == 'csittotalamount' || $idProd == 'csitunitprice'){
					$product[$idProd] = ($product[$idProd]*100);
				}
			}
			$this->products_data[] = new Product($product);
			
		}

		$this->setCSMDDS($retailData);
		$this->setProducts($this->products_data);
	}

	public function CsmddsList($data){
		$csmddsList = array();

		foreach($data as $index => $value){

			if(strstr($index, 'csmdd')){

				$fieldCode = preg_replace("/[csmdd]/", '', $index);

				$csmddsData = array(
							"code" => intval($fieldCode), 
							"description"=> $value
							);

				array_push($csmddsList, $csmddsData);
			}
		}

		return $csmddsList;
	}
	
	public function setSendToCs($index, $value) {
		$this->dataSet[$index] = $value;
	}

	public function setChannel($index, $value) {			
		$this->dataSet[$index] = $value;
	}

	public function setBillTo($index, $value) {
		$this->dataSet[$index] = $value;
	}

	public function setCurrency($index, $value) {
		$this->dataSet['purchase_totals'][$index] = $value;
	}

	public function setAmount($index, $value) {
		$this->dataSet['purchase_totals'][$index] = $value;
	}

	public function setDaysInSite($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setIsGuest($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setPassword($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setNumOfTransactions($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setCellPhoneNumber($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setDateOfBirth($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setStreet($index, $value) {
		$this->dataSet['customer_in_site'][$index] = $value;
	}

	public function setDeviceUniqueId($index, $value) {
		$this->dataSet[$index] = $value;
	}

	public function setDeliveryType($index, $value) {
		$this->dataSet['digital_goods_transaction_data'][$index] = $value;
	}
	
	public function setProducts($value) {
		$this->dataSet['digital_goods_transaction_data']['items'] = $value;
	}	
	
	public function setCSMDDS($data) {
		$csmddsResField = $this->CsmddsList($data);

		if(!empty($csmddsResField)){
			$this->dataSet['csmdds'] = $csmddsResField;
		}
	}

	public function getData(){
		return $this->dataSet;
	}

}
