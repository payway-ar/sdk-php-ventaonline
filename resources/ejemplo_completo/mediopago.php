<?php
include_once dirname(__FILE__)."/FlatDb.php";

$operationid = strip_tags($_GET['ord']);

if($_POST) {
	$orders_db = new FlatDb();
	$orders_db->openTable('ordenes');

	$ord = $orders_db->getRecords(array("id","key_public","key_private","status","data","mediodepago", "payment_response", "tokenization"),array("id" => $operationid));
	$data = json_decode($ord[0]['data'],true);	

	$paymentMethod = array("mediopago" => array(
												"tipo" => $_POST['tipo'],
												"cuotas" => $_POST['cuotas'],
												"tokenizar" => isset($_POST['tokenizar']
										)));

	$merge_data = array_merge($data, $paymentMethod);
	$orders_db->updateRecords(array("data" => json_encode($merge_data),"mediodepago" => 1),array("id" => $operationid));

	header("Location: index.php");
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
	<form id="activeform" method="POST" action="mediopago.php?ord=<?php echo $operationid; ?>" enctype="multipart/form-data">
		<table id="tablelist" class="full tablesorter">
			<tbody>
			    <tr>
				  <td><b>Medio Pago</b></td><td><select name="tipo"><option value="1">VISA</option><option value="6" >AMEX</option><option value="15" >MASTERCARD</option></select>
				  </td>
				</tr>
				<tr>
				  <td><b>Cuotas</b></td><td><select name="cuotas"><option value="1">1</option><option value="6" >6</option><option value="12" >12</option></select></td>
			    </tr>
				<tr>
					<td><b>Tarjeta - TOKENIZAR</b></td><td><div id="tokenizar-check-div"><input type="checkbox" name="tokenizar" /></div></td>
				</tr>
				</tbody>
			<tfoot>
			  <tr>
				<td colspan="2"><a href="index.php" class="btn error site">Cancelar</a>&nbsp;&nbsp;&nbsp;<a href="create.php" onclick="$('#activeform').submit();return false;" class="btn site" id="send">Enviar</a></td>
			  </tr>
			</tfoot>
		</table>
	</form>
	</div>
</div>
		</div>
		<div class="clearfix"></div>
	</div>
	<div id="footer">
	</div>
</div>
</body>
</html>
