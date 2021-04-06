<?php
namespace Decidir\Cybersource;

include_once dirname(__FILE__)."/AbstractData.php";
include_once dirname(__FILE__)."/Product.php";

class Retail extends AbstractData
{
	protected $dataSet = array();
	protected $products_data = null;
	protected $products_keys = array("csitproductcode", "csitproductdescription", "csitproductname", "csitproductsku", "csittotalamount", "csitquantity", "csitunitprice");

	public function __construct($retailData, $productsData) {

		$this->setRequiredFields(array(
			"send_to_cs" => array(
				"name" => "setSendToCs"
			),
			"channel" => array(
				"name" => "setChannel"
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
            "ship_to" => array(
                "name" => "setShipTo"
            )
		));

        $optionalFields = array(
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
            "days_to_delivery" => array(
                "name" => "setDaysToDelivery"
            ),
            "dispatch_method" => array(
                "name" => "setDispatchMethod"
            ),
            "tax_voucher_required" => array(
                "name" => "setTaxVoucherRequired"
            ),
            "customer_loyality_number" => array(
                "name" => "setCustomerLoyalityNumber"
            ),
            "coupon_code" => array(
                "name" => "setCouponCode"
            )
        );

		$csmddFields = array();
		for($i = 17; $i <= 34; $i++){
		    $csmdd = "csmdd" . $i;
		    $csmddField = array(
		        "name" => "SetCsmdd" . $i
            );
            $csmddFields[$csmdd] = $csmddField;
        }
        for($i = 43; $i <= 99; $i++){
            $csmdd = "csmdd" . $i;
            $csmddField = array(
                "name" => "SetCsmdd" . $i
            );
            $csmddFields[$csmdd] = $csmddField;
        }

        $allOptionalFields = array_merge($optionalFields, $csmddFields);

        $this->setOptionalFields($allOptionalFields);

		parent::__construct($retailData);

		$products = array();
		foreach($productsData as $index => $product) {
			foreach($product as $idProd => $value){
				if($idProd == 'csittotalamount' || $idProd == 'csitunitprice'){
					$product[$idProd] = ($product[$idProd]*100);
				}
                if(in_array($idProd, $this->products_keys)) {
                    $products[$index][$this->convertKeyProduct($idProd)] = $product[$idProd];
                }
			}
			$this->products_data[] = new Product($product);
		}
		$this->setCSMDDS($retailData);
		$this->setProducts($products);
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

	public function setShipTo($index, $value) {
		$this->dataSet['retail_transaction_data'][$index] = $value;
	}

	public function setDaysToDelivery($index, $value) {
		$this->dataSet['retail_transaction_data'][$index] = $value;
	}

	public function setDispatchMethod($index, $value) {
		$this->dataSet['retail_transaction_data'][$index] = $value;
	}

	public function setTaxVoucherRequired($index, $value) {
		$this->dataSet['retail_transaction_data'][$index] = $value;
	}

	public function setCustomerLoyalityNumber($index, $value) {
		$this->dataSet['retail_transaction_data'][$index] = $value;
	}

	public function setCouponCode($index, $value) {
		$this->dataSet['retail_transaction_data'][$index] = $value;
	}

	public function setProducts($value) {
		$this->dataSet['retail_transaction_data']['items'] = $value;
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

	public function convertKeyProduct($key){
	    switch ($key){
            case "csitproductcode":
                return "code";
                break;
            case "csitproductdescription":
                return "description";
                break;
            case "csitproductname":
                return "name";
                break;
            case "csitproductsku":
                return "sku";
                break;
            case "csittotalamount":
                return "total_amount";
                break;
            case "csitquantity":
                return "quantity";
                break;
            case "csitunitprice":
                return "unit_price";
                break;
        }
    }
	
}
