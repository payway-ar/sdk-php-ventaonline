<?php
include_once dirname(__FILE__)."/FlatDb.php";
include_once dirname(__FILE__)."/../../vendor/autoload.php";

$orders_db = new FlatDb();
$orders_db->openTable('ordenes');
$operationid = strip_tags($_GET['ord']);

$ord = $orders_db->getRecords(array("id","key_public","key_private","status","data","mediodepago", "payment_response", "refund", "tokenization"),array("id" => $operationid),array("id" => $operationid));

$header_http_data = array('public_key' => $ord[0]['key_public'],
                      'private_key' => $ord[0]['key_private']);

$ambient = "test";
$connector = new \Decidir\Connector($header_http_data, $ambient);

$paymentStatus = json_decode($ord[0]['payment_response']);
$refundStatus = json_decode($ord[0]['refund']);

$data = array();
$response = $connector->payment()->deleteRefund($data, $paymentStatus->id, $refundStatus->id);


$refundResponse = array();

if(!($response->getStatus() != NULL)){
	$refundResponse['validation_error'] = $response->getValidation_errors();
	$refundResponse['error_type'] = $response->getError_type();

}else{
	$refundResponse['id'] = $response->getId();
	$refundResponse['status'] = $response->getStatus();
	$refundResponse['amount'] = $response->getAmount();
	$refundResponse['sub_payments'] = $response->getSub_payments();
}	

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
<div id="container">
	<div id="content">
		<div class="w-content">
		  <div class="w-section"></div>
			<div id="m-status" style="margin-bottom: 300px">

				<div class="block">
					<table id="tablelist" class="full tablesorter">
						<thead>
							<p>Resultado de la devolucion: </p>
							<tr>
								<th class="header">Campo</th>
								<th class="header">Resultado</th>
								
							</tr>
						</thead>
						<tbody>
							<?php foreach($refundResponse as $index => $data): ?>
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
				<a href="index.php">Volver</a>
			</div> 
		</div>
		<div class="clearfix"></div>
	</div>
	<div id="footer">
	</div>
</div>
</body>
</html>
