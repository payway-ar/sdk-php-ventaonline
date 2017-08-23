<?php
include_once dirname(__FILE__)."/../vendor/autoload.php";

$keys_data = array('public_key' => 'e9cdb99fff374b5f91da4480c8dca741',
		   		   'private_key' => '92b71cf711ca41f78362a7134f87ff65');

$ambient = "test";//valores posibles "test" o "prod"

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


//------------------------ejecucion de pago--------------------------

$data = array(
			  "site_transaction_id" => "130717_06",
			  "token" => "850c2092-ee57-45a7-ada3-d6075ff753ca",
			  "user_id" => "prueba",
			  "payment_method_id" => 1,
			  "amount" => 12.00,
			  "bin" => "450799",
			  "currency" => "ARS",
			  "installments" => 1,
			  "description" => "prueba",
			  "payment_type" => "single",
			  "sub_payments" => array(),
			  "fraud_detection" => array()
);

//Datos Cybersource retail 
$cs_data = array(
				"send_to_cs" => true,
				"channel" => "Web",
				"bill_to" => array(
					"city" => "Buenos Aires",
					"country" => "AR",
					"customer_id" => "martinid",
					"email" => "accept@decidir.com.ar",
					"first_name" => "martin",
					"last_name" => "perez",
					"phone_number" => "1547766111",
					"postal_code" => "1768",
					"state" => "BA",
					"street1" => "GARCIA DEL RIO 3333",
					"street2" => "GARCIA DEL RIO 3333",
				),
				"ship_to" => array(
					"city" => "Buenos Aires",
					"country" => "AR",
					"customer_id" => "martinid",
					"email" => "accept@decidir.com.ar",
					"first_name" => "martin",
					"last_name" => "perez",
					"phone_number" => "1547766111",
					"postal_code" => "1768",
					"state" => "BA",
					"street1" => "GARCIA DEL RIO 3333",
					"street2" => "GARCIA DEL RIO 3333",
				),
				"currency" => "ARS",
				"amount" => 12.00,
				"days_in_site" => 243,
				"is_guest" => false,
				"password" => "password",
				"num_of_transactions" => 1,
				"cellphone_number" => "12121",
				"date_of_birth" => "129412",
				"street" => "RIO 4041",
				"days_to_delivery" => "55",
				"dispatch_method" => "storepickup",
				"tax_voucher_required" => true,
				"customer_loyality_number" => "123232",
				"coupon_code" => "cupon22",
				"csmdd17" => "17"
			);


//lista de productos cybersource
$cs_products = array(
					array(
						"csitproductcode" => "popblacksabbat2016",
		                "csitproductdescription" => "Popular Black Sabbath 2016",
		                "csitproductname" => "popblacksabbat2016ss",
		                "csitproductsku" => "asas",
		                "csittotalamount" => 6.00,
		                "csitquantity" => 1,
		                "csitunitprice" => 6.00
				    ),
					array(
						"csitproductcode" => "popblacksabbat2017",
		                "csitproductdescription" => "Popular Black Sabbath 2017",
		                "csitproductname" => "popblacksabbat2017ss",
		                "csitproductsku" => "asas",
		                "csittotalamount" => 6.00,
		                "csitquantity" => 1,
		                "csitunitprice" => 6.00
					)
				);

//$cybersource = new \Decidir\Cybersource\Retail($cs_data, $cs_products);
//$cybersource = new \Decidir\Cybersource\DigitalGoods($cs_data, $cs_products);
//$cybersource = new \Decidir\Cybersource\Ticketing($cs_data, $cs_products);

//echo("Cybersource Data<br>");
//var_dump($cybersource->getData());
//echo("<br>----------------------------------<br><br>");

//$connector->payment()->setCybersource($cybersource->getData());

try {
	$response = $connector->payment()->ExecutePayment($data);
	echo("Respuest payment<br>");
	print_r($response);

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}

//--------------------------lista de pagos----------------------------
/*
$data = array();

var_dump(json_encode($data));
echo("<br>");

$response = $connector->payment()->PaymentList($data);
echo("Respuesta lista de pagos<br>");
//var_dump($response);
echo("Limite: ".$response->getLimit()."<br>");
echo("Offset: ".$response->getOffset()."<br>");
echo("Result:");
var_dump($response->getResults());
echo("HasMore: ".$response->getHasMOre()."<br>");


//------------------------informacion de pago------------------------------

$data = array();

var_dump(json_encode($data));
echo("<br>");

$response = $connector->payment()->PaymentInfo($data, '575625');

echo("Respuesta informacion de pago<br>");
if($response->getStatus() == "approved"){
	echo($response->getId()."<br>");
	echo($response->getToken()."<br>");
	echo($response->getUserId()."<br>");
	echo($response->getAmount()."<br>");
}else{
	print_r($response->getValidationErrors());
}


//-------------------------devolucion----------------------------------

$data = array();

var_dump(json_encode($data));
echo("<br>");
$response = $connector->payment()->Refund($data, '575499');

echo("Respuest anulacion-devolucion total<br>");
var_dump($response);
echo($response->getId()."<br>");
echo($response->getAmount()."<br>");
var_dump($response->getSubPayments());
echo($response->getStatus()."<br>");


//------------------------anular devolucion total------------------------

$data = array();

var_dump(json_encode($data));
echo("<br>");

$response = $connector->payment()->deleteRefund($data, '574940', '271');

echo("Respuesta de anulacion de devolucion<br>");
var_dump($response);
echo($response->getResponse());
echo($response->getstatus());


//-------------------------devolucion parcial--------------------------

$data = array(
		"amount" => 5.00
	);

$response = $connector->payment()->partialRefund($data,'577244');

echo("Respuest anulacion-devolucion total<br>");
var_dump($response);
echo("<br>-------<br>");
echo("Id: ".$response->getId()."<br>");
echo("Monto: ".$response->getAmount()."<br>");
echo("Subpayment: <br>");
var_dump($response->getSubPayments());
echo("Status:".$response->getStatus()."<br>");


//------------------------anulacion de devolucion--------------------------

$data = array();

$response = $connector->payment()->deletePartialRefund($data, '575503', '638');

echo("Respuesta de anulacion de devolucion<br>");
var_dump($response);
echo("<br>-------<br>");
echo("Respuesta: ".$response->getResponse());
echo("Status: ".$response->getstatus());
echo("Tipo de error:".$response->getErrorType());
echo("Errores: ".$response->getValidationErrors());


//---------------------------------------------------------------------
//---------------------------------------------------------------------
//-------------------------TOKENIZACION--------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------

//----------------------Listado de tarjetas tokenizadas --------------------

$response = $connector->cardToken()->tokensList($data, "pepe");
echo("Respuesta de listado de tarjetas tokenizadas<br>");
var_dump($response);
echo("<br>---------------<br>");
echo("Token:");
var_dump($response->getTokens());


//------------------------Eliminacion de token------------------------

echo("Request servicio eliminacion de token<br>");
$data = array();

$response = $connector->cardToken()->tokenCardDelete($data, '7bed5c10-a70b-4c6d-92b2-4d9170b1c0e4');
echo("Respuest payment<br>");
var_dump($response);

echo("Error type:".$response->getErrorType());
echo("Nombre: ".$response->getEntityName());
echo("Id".$response->getId());
*/
