<?php
include_once dirname(__FILE__)."/FlatDb.php";
include_once dirname(__FILE__)."/../../Decidir/lib/Connector.php";

$orders_db = new FlatDb();
$orders_db->openTable('ordenes');

$operationid = strip_tags($_GET['ord']);

$ord = $orders_db->getRecords(array("id","key_public","key_private","status","data","mediodepago", "payment_response", "tokenization"),array("id" => $operationid),array("id" => $operationid));

$data = json_decode($ord[0]['data']);

$header_http_data = array('public_key' => $ord[0]['key_public'],
                          'private_key' => $ord[0]['key_private']);

$ambient = "test";

if($data->mediopago->tipo == 1){
  $tarjeta = "VISA";
}else{
  $tarjeta = "Mastercard";
}

if($_POST){

  $connector = new \Decidir\Connector($header_http_data, $ambient);
  //Solicitud de token
  $tokenRequestdata = array(
          "card_number" => $_POST['credit_card'],
          "card_expiration_month" => $_POST['mes'],
          "card_expiration_year" => $_POST['anio'],
          "security_code" => $_POST['codigo_seguridad'],
          "card_holder_name" => $_POST['nombre_titular'],
          "card_holder_identification" => array(
                            "type"=>"dni",
                            "number"=>$_POST['dni']
                          )
        );
  
  //falta seccion get token de pago
  
  //execute payment
  $PaymentRequestdata = array(
        "site_transaction_id" => $operationid,
        "token" => $response->getId(),
        "user_id" => $data->user_id,
        "payment_method_id" => intval($data->mediopago->tipo),
        "bin" => $_POST['bin'],
        "amount" => intval($_POST['amount']),
        "currency" => $data->currency,
        "installments" => intval($data->cuotas),
        "description" => $_POST['description'],
        "payment_type" => "single",
        "sub_payments" => array()
      );

  $response = $connector->payment()->ExecutePayment($PaymentRequestdata);
  $paymentSData = array(
                        "id"=> $response->getId(),
                        "site_transaction_id"=> $response->getSiteTransactionId(),
                        "token"=> $response->getToken(),
                        "user_id"=> $response->getUserId(),
                        "payment_method_id"=> $response->getpaymentMethodId(),
                        "card_brand"=> $response->getCardBrand(),
                        "bin"=> $response->getBin(),
                        "amount"=> $response->getAmount(),
                        "currency"=> $response->getCurrency(),
                        "installments"=> $response->getInstallments(),
                        "payment_type"=> $response->getPaymentType(),
                        "sub_payments"=> $response->getSubPayments(),
                        "status"=> $response->getStatus(),
                        "status_details"=> $response->getStatusDetails(),
                        "date"=> $response->getDate(),
                        "merchant_id"=> $response->getMerchantId(),
                        "establishment_name"=> $response->getEstablishmentName(),
                        "fraud_detection"=> $response->getFraudDetection(),
                        "aggregate_data"=> $response->getAggregateData()
                        );

  if($response->getStatus() == "approved"){
    $payments_tatus = 1;
  }else{
    $payments_tatus = 0;
  }

  $orders_db->updateRecords(array("payment_response" => json_encode($paymentSData), "payment" => $payments_tatus),array("id" => $operationid));

  header("Location: index.php");
}

?>

<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.js" integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"></script>
  <script type="text/javascript">
  </script>
</head>
  <body class="paybox">
    <h1>Formulario de Pago</h1>
    <div id="form-container">
      <div id="card-form-div">
        <form id="activeform" method="POST" action="pagar.php?ord=<?php echo $operationid; ?>" enctype="multipart/form-data">
            <table id="tablelist" class="full tablesorter">
              <tbody>
                <tr>
                  <td><b>Numero de tarjeta</b></td>
                  <td><input type="text" name="credit_card" value=""></input></td>
                </tr>
                <tr>
                  <td><b>bin</b></td>
                  <td><input type="text" name="bin" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Mes Vencimiento</b></td>
                  <td><input type="text" name="mes" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Año Vencimiento </b></td>
                  <td><input type="text" name="anio" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Codigo de Seguridad</b></td>
                  <td><input type="text" name="codigo_seguridad" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Nombre titular</b></td>
                  <td><input type="text" name="nombre_titular" value=""></input></td>
                </tr>
                <tr>
                  <td><b>DNI</b></td>
                  <td><input type="text" name="dni" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Monto</b></td>
                  <td><input type="text" name="amount" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Description</b></td>
                  <td><input type="text" name="description" value="Pagar con <?php echo $tarjeta ?>"></input></td>
                </tr>
              <tfoot>
                <tr>
                <td colspan="2"><a href="index.php" class="btn error site">Cancelar</a>&nbsp;&nbsp;&nbsp;<a href="create.php" onclick="$('#activeform').submit();return false;" class="btn site" id="send">Enviar</a></td>
                </tr>
              </tfoot>
            </table>
          </form>
      </div>
</body>
</html>
