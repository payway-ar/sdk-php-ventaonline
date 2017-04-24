<?php
include_once dirname(__FILE__)."/FlatDb.php";
include_once dirname(__FILE__)."/../../Decidir/lib/Connector.php";

$orders_db = new FlatDb();
$orders_db->openTable('ordenes');

$operationid = strip_tags($_GET['ord']);

$ord = $orders_db->getRecords(array("id","key_public","key_private","status","data","mediodepago", "payment_response", "tokenization"),array("id" => $operationid),array("id" => $operationid));

if($_POST) {
	$paymentStatus = json_decode($ord[0]['payment_response'],true);

	$header_http_data = array('public_key' => $ord[0]['key_public'],
                          'private_key' => $ord[0]['key_private']);

	$ambient = "test";

	$connector = new \Decidir\Connector($header_http_data, $ambient);
	

	if($_POST['tipo'] == "parcial"){
		$data = array("amount" => intval($_POST['monto']));
		$response = $connector->payment()->partialRefund($data, $paymentStatus['id']);

	}else{
		$data = array();
		$response = $connector->payment()->Refund($data, $paymentStatus['id']);
	}


	$RefundResponse = array(
						"id" => $response->getId(),
						"amount" => $response->getAmount(),
						"status" => $response->getStatus()
			);

	var_dump($RefundResponse);
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
				<form id="activeform" method="POST" action="devolver.php?ord=<?php echo $operationid; ?>" enctype="multipart/form-data">
					<table id="tablelist" class="full tablesorter">
						<tbody>
							<tr>
								<td><b>Tipo Devolucion</b></td>
								<td><select name="tipo">
										<option value="total">Total</option>
										<option value="parcial">Parcial</option>
								   </select>
								</td>
							</tr>
							<tr>
							  <td><b>Monto</b></td><td><input type="text" name="monto" value="10.00"></input></td>
							</tr>				
						</tbody>	
						<tfoot>
						  <tr>
							<td colspan="2"><a href="index.php" class="btn error site">Cancelar</a>&nbsp;&nbsp;&nbsp;<a href="devolver.php" onclick="$('#activeform').submit();return false;" class="btn site" id="send">Enviar</a></td>
						  </tr>
						</tfoot>
					</table>		
				</form>
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
