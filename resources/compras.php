<?php
include_once dirname(__FILE__)."/../vendor/autoload.php";

$keys_data = array('public_key' => '96e7f0d36a0648fb9a8dcb50ac06d260',
    'private_key' => '1b19bb47507c4a259ca22c12f78e881f');

$ambient = "test";    //valores posibles: "test" o "prod"

$connector = new \Decidir\Connector($keys_data, $ambient);

echo("Healthcheck Service<br><br>");
$response = $connector->healthcheck()->getStatus();

echo("<br>Respuest healthcheck<br>");

var_dump($response);

echo("<br><br>");
echo("Name: ".$response->getName())."<br>";
echo("Version: ".$response->getVersion())."<br>";
echo("BuildTime: ".$response->getBuildTime())."<br>";
echo("--------------------------------------------<br><br>");

$data = array(
    "site_transaction_id" => "02032021_05_ISA_MEZE",
    "token" => "c272f617-da66-4b13-8af0-97f54ef18a90",
    "customer" => array(
        "id" => "customer",
        "email" => "user@mail.com"
                        ),
      "payment_method_id" => 1,
      "bin" => "450799",
      "amount" => 5.00,
      "currency" => "ARS",
      "installments" => 1,
      "description" => "",
      "establishment_name" => "Nombre establecimiento",
      "payment_type" => "single",
      "sub_payments" => array(),
      "fraud_detection" => array(),
      "ip_address" => "192.168.100.2"
    );


/*
$data = array(
			  "site_transaction_id" => "02032021_05",
			  "token" => "3ae239c8-81a8-4cb5-a104-e488d878c210",
			  "customer" => array(
			  					"id" => "morton",
			  					"email" => "santiago.figueroa@redb.ee"
			  					),
			  "payment_method_id" => 65,
			  "amount" => 1000,
			  "bin" => "373953",
			  "currency" => "ARS",
			  "installments" => 1,
			  "description" => "prueba qa",
			  "payment_type" => "single",
			  "establishment_name" => "Prueba desa soft",
			  "sub_payments" => array(),
			  "fraud_detection" => array(),
			  "ip_address" => "127.0.0.1"
);

*/
    $response = $connector->payment()->ExecutePayment($data);
    var_dump($response);

/*
try {
    $response = $connector->payment()->ExecutePayment($data);
    $response->getId();
    $response->getToken();
    $response->getUser_id();
    $response->getPayment_method_id();
    $response->getBin();
    $response->getAmount();
    $response->getCurrency();
    $response->getInstallments();
    $response->getPayment_type();
    $response->getDate_due();
    $response->getSub_payments();
    $response->getStatus();
    $response->getStatus_details()->ticket;
	$response->getStatus_details()->card_authorization_code;
	$response->getStatus_details()->address_validation_code;
	$response->getStatus_details()->error;
	$response->getDate();
	$response->getEstablishment_name();
	$response->getFraud_detection();
	$response->getAggregate_data();
	$response->getSite_id();
	var_dump($response);
} 
catch( \Exception $e ) {
    var_dump($e);
} */

?>