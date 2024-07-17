<?php
namespace Decidir\Cybersource;

abstract class AbstractData extends \Decidir\Data\AbstractData
{	
	private $field_required = array();
	private $field_optional = array();

	public function __construct(array $data){
	    $this->dataResponse = $data;
	    $simplificatedData = $data;
		$nameMethod = "";

        if(array_key_exists("bill_to", $data)){
            $bill_to = $data['bill_to'];
            unset($simplificatedData['bill_to']);
            $simplificatedData['bill_to'] = array();
        }
        if(array_key_exists("ship_to", $data)){
            $ship_to = $data['ship_to'];
            unset($simplificatedData['ship_to']);
            $simplificatedData['ship_to'] = array();
        }

        parent::setRequiredFields($this->getRequiredFields($data));
        parent::setOptionalFields($this->getOptionalFields());
        parent::__construct($simplificatedData);

        foreach($this->field_required as $index => $param){
            if(array_key_exists($index, $data)){
                $nameMethod = $param['name'];
                $this->$nameMethod($index, $this->dataResponse[$index]);
            }
        }
        //procesamiento de campos adicionales
        foreach($this->field_optional as $index => $param){
            if(array_key_exists($index, $data)){
                $nameMethod = $param['name'];
                $this->$nameMethod($index, $this->dataResponse[$index]);
            }
        }

        if(array_key_exists("bill_to", $data)){
            parent::setRequiredFields($this->getOthersRequiredFieldsBillTo());
            parent::setOptionalFields($this->getOthersOptionalFields());

        }
        if(array_key_exists("ship_to", $data)){
            parent::setRequiredFields($this->getOthersRequiredFieldsShipTo());
            parent::setOptionalFields($this->getOthersOptionalFieldsShipTo());
        }

        if(array_key_exists("bill_to", $data)){
            parent::__construct($bill_to);
            $this->dataSet['bill_to'] = $bill_to;
        }
        if(array_key_exists("ship_to", $data)){
            parent::__construct($ship_to);
            $this->dataSet['retail_transaction_data']['ship_to'] = $ship_to;
        }
	}

	public function setRequiredFields($data){
		$this->field_required = $data;
	}

	public function setOptionalFields($data){
	    $this->field_optional = $data;
    }

    public function getOthersRequiredFieldsBillTo(){
        return array(
            "city" => array(
                "name" => "setCity"
            ),
            "country" => array(
                "name" => "setCountry"
            ),
            "email" => array(
                "name" => "setEmail"
            ),
            "first_name" => array(
                "name" => "setFirstName"
            ),
            "last_name" => array(
                "name" => "setLastName"
            ),
            "phone_number" => array(
                "name" => "setPhoneNumber"
            ),
            "postal_code" => array(
                "name" => "setPostalCode"
            ),
            "state" => array(
                "name" => "setState"
            ),
            "street1" => array(
                "name" => "setStreet1"
            ),
	    "customer_id" => array(
            	"name" => "setCustomerId"
            )
        );
    }

    public function getOthersRequiredFieldsShipTo(){
        return array(
            "city" => array(
                "name" => "setCity"
            ),
            "country" => array(
                "name" => "setCountry"
            ),
            "email" => array(
                "name" => "setEmail"
            ),
            "first_name" => array(
                "name" => "setFirstName"
            ),
            "last_name" => array(
                "name" => "setLastName"
            ),
            "phone_number" => array(
                "name" => "setPhoneNumber"
            ),
            "postal_code" => array(
                "name" => "setPostalCode"
            ),
            "state" => array(
                "name" => "setState"
            ),
            "street1" => array(
                "name" => "setStreet1"
            )
        );
    }

    public function getOthersOptionalFields(){
        return array(
            "street2" => array(
                "name" => "setStreet2"
            )
        );
    }

   public function getOthersOptionalFieldsShipTo(){
        return array(
            "street2" => array(
                "name" => "setStreet2"
            ),
            "customer_id" => array(
                "name" => "setCustomer_id"
            )
        );
    }

   public function getRequiredFields($data){
	return $this->field_required;
   }
	
	public function getOptionalFields(){
	    return $this->field_optional;
    }

	public function getDataField(){
		return $this->dataResponse;
	}
}
