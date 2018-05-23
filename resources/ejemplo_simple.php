<?php
include_once dirname(__FILE__)."/../vendor/autoload.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

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
/*
$data = array(
			  "site_transaction_id" => "130717_06",
			  "token" => "850c2092-ee57-45a7-ada3-d6075ff753ca",
			  "customer" => array("id" => "usuario_prueba", "email" => "email@server.com"),
			  "payment_method_id" => 1,
			  "amount" => 12.00,
			  "bin" => "450799",
			  "currency" => "ARS",
			  "installments" => 1,
			  "description" => "prueba",
			  "payment_type" => "single",
			  "establishment_name" => "Establecimiento test",
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
*/
//$cybersource = new \Decidir\Cybersource\Retail($cs_data, $cs_products);
//$cybersource = new \Decidir\Cybersource\DigitalGoods($cs_data, $cs_products);
//$cybersource = new \Decidir\Cybersource\Ticketing($cs_data, $cs_products);
//$cybersource = new \Decidir\Cybersource\Travel($cs_data, $cs_passenger);
//$cybersource = new \Decidir\Cybersource\Service($cs_data, $cs_products);
/*
echo("Cybersource Data<br>");
var_dump($cybersource->getData());
echo("<br>----------------------------------<br><br>");

$connector->payment()->setCybersource($cybersource->getData());

try {
	$response = $connector->payment()->ExecutePayment($data);
	echo("Respuest payment<br>");
	print_r($response);

	echo("<br><br>");
	echo("Status: ".$response->getStatus()."<br><br>");

	echo("Status detail<br>");
	echo("Ticket:".$response->getStatus_details()->ticket."<br>");
	echo("Card Authorization Code: ".$response->getStatus_details()->card_authorization_code."<br>");
	echo("Address Validation Code : ".$response->getStatus_details()->address_validation_code."<br>");
	var_dump($response->getStatus_details()->error);//echo(print_r($response->getStatus_details()->error,true));

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}
*/
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
$query = array("expand"=>"card_data");

var_dump(json_encode($data));
echo("<br>");

$response = $connector->payment()->PaymentInfo($data, '914361', $query);

print_r($response);

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

//---------------------------------------------------------------------
//---------------------------------------------------------------------
//-------------------------PAGO OFFLINE--------------------------------
//---------------------------------------------------------------------
//---------------------------------------------------------------------

//------------------------- Token -------------------------------------
/*
echo("Get offline payment token<br><br>");

$data = array(
				"name" => "Pepe Test", 
				"type" => "dni", 
				"number" => "23968498"
			);

$response = $connector->paymentToken()->tokenPaymentOffline($data);

print_r($response);

print_r("<br><br><br>");
print($response->getId()."<br>");
print($response->getStatus()."<br>");
print($response->getDate_created()."<br>");
print($response->getDate_due()."<br>");
print_r($response->getCustomer());
*/

//---------------------- Payment offline Rapipago------------------------------
/*
$data = array(
	"site_transaction_id" => "230518_38",
	"token" => "8e190c82-6a63-467e-8a09-9e8fa2ab6215",
	"payment_method_id" => 26,
	"amount" => 10.00,
	"currency" => "ARS",
	"payment_type" => "single",
	"email" => "user@mail.com",
	"invoice_expiration" => "191123",
	"cod_p3" => "12",
	"cod_p4" => "134",
	"client" => "12345678",
	"surcharge" => 10.01,
	"payment_mode" => "offline"
);

print_r($data,true);
echo("<br>");

try {
	$response = $connector->payment()->ExecutePaymentOffline($data);
	echo("Respuest payment offline Rapipago<br>");
	
	print_r($response);

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}
*/
//---------------------- Payment offline Pago mis Cuentas------------------------------
/*
$data = array(
	"site_transaction_id" => "220518_39",
	"token" => "9ae1d130-8c89-4c3b-a267-0e97b88fedd0",
	"payment_method_id" => 41,
	"amount" => 10.00,
	"currency" => "ARS",
	"payment_type" => "single",
	"email" => "user@mail.com",
	"bank_id" => 1,
	"sub_payments" => 100,
	"invoice_expiration" => "191123"
);

print_r($data,true);
echo("<br>");

try {
	
	$response = $connector->payment()->ExecutePaymentOffline($data);
	echo("Respuest payment offline PMC<br>");
	
	print_r($response);
	

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}
*/
//---------------------- Payment offline Pago Facil------------------------------
/*
$data = array(
	"site_transaction_id" => "230518_41",
	"token" => "92a95793-3321-447c-8795-8aeb8a8ac067",
	"payment_method_id" => 25,
	"amount" => 10.00,
	"currency" => "ARS",
	"payment_type" => "single",
	"email" => "user@mail.com",
	"invoice_expiration" => "191123",
	"cod_p3" => "12",
	"cod_p4" => "134",
	"client" => "12345678",
	"surcharge" => 10.01,
	"payment_mode" => "offline"
);

print_r($data,true);
echo("<br>");

try {
	
	$response = $connector->payment()->ExecutePaymentOffline($data);
	echo("Respuest payment offline Pago Facil<br>");
	
	print_r($response);
	

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}
*/
//---------------------- Payment offline Cobro Express------------------------------
/*
$data = array(
	"site_transaction_id" => "160518_42",
	"token" => "3df26771-67ab-4a8e-91e2-f1e0b0c559f7",
	"payment_method_id" => 51,
	"amount" => 10.00,
	"currency" => "ARS",
	"payment_type" => "single",
	"email" => "user@mail.com",
	"invoice_expiration" => "191123",
	"second_invoice_expiration" => "191123",
	"cod_p3" => "1",
	"cod_p4" => "134",
	"client" => "12345678",
	"surcharge" => 10.01,
	"payment_mode" => "offline"
);

print_r($data,true);
echo("<br>");

try {
	
	$response = $connector->payment()->ExecutePaymentOffline($data);
	echo("Respuest payment offline Cobro Express<br>");
	
	print_r($response);
	

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}
*/
//---------------------- Payment offline Caja de Pagos------------------------------
/*
$data = array(
	"site_transaction_id" => "220518_43",
	"token" => "9877eb35-0d7c-4d56-bd78-d9ad1d27c7f0",
	"payment_method_id" => 48,
	"amount" => 10.00,
	"currency" => "ARS",
	"payment_type" => "single",
	"email" => "user@mail.com",
	"invoice_expiration" => "191123",
	"second_invoice_expiration" => "191123",
	"cod_p3" => "1",
	"client" => "12345678",
	"surcharge" => 10.01,
	"payment_mode" => "offline"
);

print_r($data,true);
echo("<br>");

try {
	
	$response = $connector->payment()->ExecutePaymentOffline($data);
	echo("Respuest payment offline Caja de Pagos<br>");
	
	print_r($response);
	

} catch(\Exception $e) {
	echo("Error Respuest payment<br>");
	var_dump($e->getData());
}
*/