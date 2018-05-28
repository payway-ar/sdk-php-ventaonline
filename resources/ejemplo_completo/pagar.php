<?php
include_once dirname(__FILE__)."/FlatDb.php";
include_once dirname(__FILE__)."/../../vendor/autoload.php";
$orders_db = new FlatDb();
$orders_db->openTable('ordenes');

$operationid = strip_tags($_GET['ord']);
$status = "PAGADO";

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

  //execute payment
  $PaymentRequestdata = array(
        "site_transaction_id" => $operationid,
        "token" => $_POST['payment_token'],
        "customer" => array("id" => $data->user_id, "email" => $data->user_mail),
        "payment_method_id" => intval($data->mediopago->tipo),
        "bin" => $_POST['bin'],
        "amount" => intval($_POST['amount']),
        "currency" => $data->currency,
        "installments" => intval($data->cuotas),
        "description" => $_POST['description'],
        "payment_type" => "single",
        "establishment_name" => $data->stablishment,
        "sub_payments" => array(),
        "fraud_detection"=> array()
      );

  $response = $connector->payment()->ExecutePayment($PaymentRequestdata);

  $paymentSData = array(
                        "id"=> $response->getId(),
                        "site_transaction_id"=> $response->getSite_transaction_id(),
                        "user_id"=> $response->getId(),
                        "customer"=> $response->getCustomer(),
                        "payment_method_id"=> $response->getPayment_method_id(),
                        "bin"=> $response->getBin(),
                        "amount"=> $response->getAmount(),
                        "currency"=> $response->getCurrency(),
                        "installments"=> $response->getInstallments(),
                        "payment_type"=> $response->getPayment_type(),
                        "sub_payments"=> $response->getSub_payments(),
                        "status"=> $response->getStatus(),
                        "status_details"=> $response->getStatus_details(),
                        "date"=> $response->getDate(),
                        "establishment_name"=> $response->getEstablishment_name(),
                        "fraud_detection"=> $response->getFraud_detection(),
                        "aggregate_data"=> $response->getAggregate_data()
                      );

  if($response->getStatus() == "approved"){
    $payment_status = 1;
    $status = "PAGADO";
  }else{
    $payment_status = 0;
    $status = "NO SE PUDO REALIZAR";
  }

  $orders_db->updateRecords(array("payment_response" => json_encode($paymentSData), "payment" => $payment_status, "status" => $status),array("id" => $operationid));

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
                  <td><b>Token de Pago</b></td>
                  <td><input type="text" name="payment_token" value=""></input></td>
                </tr>
                <tr>
                  <td><b>Bin</b></td>
                  <td><input type="text" name="bin" value=""></input></td>
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
