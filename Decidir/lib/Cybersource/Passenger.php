<?php
namespace Decidir\Cybersource;

include_once dirname(__FILE__)."/../Data/AbstractData.php";

class Passenger extends \Decidir\Data\AbstractData {
    protected $email;
    protected $first_name;
    protected $last_name;
    protected $passport_id;
    protected $phone;
    protected $passenger_status;
    protected $passenger_type;

	public function __construct($productData) {
		$this->setRequiredFields(array(
			"email" => array(
				"name" => "email",
			),
			"first_name" => array(
				"name" => "first_name",
			),
			"last_name" => array(
				"name" => "last_name",
			),
			"passport_id" => array(
				"name" => "passport_id",
			),
			"phone" => array(
				"name" => "phone",
			),
			"passenger_status" => array(
				"name" => "passenger_status",
			),
			"passenger_type" => array(
				"name" => "passenger_type",
			)
		));

		parent::__construct($productData);
	}
	
	public function getEmail() {
		return $this->email;
	}

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getFirstName() {
        return $this->first_name;
    }

    public function setFirstName($firstname) {
        $this->first_name = $firstname;
    }

    public function getLastName() {
        return $this->last_name;
    }

    public function setLastName($lastname) {
        $this->last_name = $lastname;
    }

    public function getPassportId() {
        return $this->passport_id;
    }

    public function setPassportId($passportid) {
        $this->passport_id = $passportid;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function getPassengerStatus() {
        return $this->passenger_status;
    }

    public function setPassengerStatus($passengerstatus) {
        $this->passenger_status = $passengerstatus;
    }

    public function getPassengerType() {
        return $this->passenger_type;
    }

    public function setPassengerType($passengertype) {
        $this->passenger_type = $passengertype;
    }
}
