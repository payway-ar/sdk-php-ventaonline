<?php
include_once dirname(__FILE__)."/FlatDb.php";
include_once dirname(__FILE__)."/../../vendor/autoload.php";


$orders_db = new FlatDb();
$orders_db->openTable('ordenes');

$operationid = strip_tags($_GET['ord']);

$ord = $orders_db->getRecords(array("id","key_public","key_private","status","data","mediodepago", "payment_response", "payment", "tokenization"),array("id" => $operationid),array("id" => $operationid));

$payment_response = json_decode($ord[0]['payment_response'],true);

$header_http_data = array('public_key' => $ord[0]['key_public'],
                          'private_key' => $ord[0]['key_private']);
$ambient = "test"; //valores posibles: "test" , "prod" o "qa"

$connector = new \Decidir\Connector($header_http_data, $ambient);

$data = array();
$query = array("expand"=>"card_data");

$response = $connector->payment()->PaymentInfo($data, $payment_response['id'], $query);

$statusResponse = array(
                        //"id"=> $response->getId(),
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
                        "date"=> $response->getDate(),
                        "establishment_name"=> $response->getEstablishment_name(),
                        "aggregate_data"=> $response->getAggregate_data(),
                        "card_data" => $response->getCardData()
			);	
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<title>Administrador</title>
	<meta name="description" content="kleith web site" />
	<meta name="keywords" content="html, css, js, php" />
        <!-- Le styles -->
	<link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">

	<script src="https://code.jquery.com/jquery-3.2.1.slim.js" integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"></script>

	<style>
		.ui-tooltip {
			padding: 10px 20px;
			color: black;
			background-color:white;
			width: 200px;
			text-align:center;
			border-radius: 20px;
			font: bold 14px "Helvetica Neue", Sans-Serif;
			text-transform: uppercase;
			box-shadow: 0 0 7px black;
		}
	</style>
</head>
<body>
	<div class="block">
		<table id="tablelist" class="full tablesorter">
			<thead>
				<tr>
					<th class="header">Campo</th>
					<th class="header">Resultado</th>
					
				</tr>
			</thead>
			<tbody>
				<?php foreach($statusResponse as $index => $data): ?>
				<tr>
					<td>
						<?php echo($index); ?>
					</td>
					<td>
						<?php 
							if(is_array($data)){
								print_r($data);
							}else{
								echo($data);
							}
						?>
					</td>
				</tr>
				<?php endforeach;?>
			</tbody>
			<tfooter>
		</tfooter>	
	</table>
	</div>	
<br>
<a href="index.php">Volver</a>
</body>
</html>
