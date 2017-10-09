<?php
namespace Decidir\Cybersource;

include_once dirname(__FILE__)."/AbstractData.php";
include_once dirname(__FILE__)."/Passenger.php";

class Travel extends AbstractData
{
	protected $dataSet = array();
	protected $passenger_data = null;

	public function __construct($travelData, $passengerData) {

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
			"ship_to" => array(
				"name" => "setShipTo"
			),
            "reservation_code" => array(
                "name" => "setReservationCode"
            ),
            "third_party_booking" => array(
                "name" => "setThirdPartyBooking"
            ),
            "departure_city" => array(
                "name" => "setDepartureCity"
            ),
            "final_destination_city" => array(
                "name" => "setFinalDestinationCity"
            ),
            "international_flight" => array(
                "name" => "setInternationalFlight"
            ),
            "frequent_flier_number" => array(
                "name" => "setFrequentFlierNumber"
            ),
            "class_of_service" => array(
                "name" => "setClassOfService"
            ),
            "day_of_week_of_flight" => array(
                "name" => "setDayOfWeekOfFlight"
            ),
            "week_of_year_of_flight" => array(
                "name" => "setWeekOfYearOfFlight"
            ),
            "airline_code" => array(
                "name" => "setAirlineCode"
            ),
            "code_share" => array(
                "name" => "setCodeShare"
            ),
            "decision_manager_travel" => array(
                "name" => "setDecisionManagerTravel"
            ),
            "airline_number_of_passengers" => array(
                "name" => "setAirlineNumberOfPassengers"
            )
		));

		parent::__construct($travelData);

        foreach($passengerData as $index => $passenger){

            $this->passenger_data[] = new Passenger($passenger);

		}

		$this->setPassenger($this->passenger_data);
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
		$this->dataSet['travel_transaction_data'][$index] = $value;
	}

    public function setReservationCode($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setThirdPartyBooking($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setDepartureCity($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setFinalDestinationCity($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setInternationalFlight($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setFrequentFlierNumber($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setClassOfService($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setDayOfWeekOfFlight($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setWeekOfYearOfFlight($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setAirlineCode($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setCodeShare($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setDecisionManagerTravel($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

    public function setAirlineNumberOfPassengers($index, $value) {
        $this->dataSet['travel_transaction_data'][$index] = $value;
    }

	public function setPassenger($value) {
		$this->dataSet['travel_transaction_data']['passengers'] = $value;
	}

	public function getData(){
		return $this->dataSet;
	}
	
}
