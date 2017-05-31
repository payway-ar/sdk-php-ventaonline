<?php
include_once dirname(__FILE__)."/FlatDb.php";

if($_POST){

	var_dump($_POST);

	$orders_db = new FlatDb();
	$orders_db->openTable('ordenes');
	$operation_id = $_POST['operacion'];
	$key_public = $_POST['key_public'];
	$key_private = $_POST['key_private'];
	$status = "PENDIENTE";
	$data = array(
				"currency" => $_POST['currency'],
				"user_id" => $_POST['user_id'],
				"cuotas" => $_POST['cuotas']
			);
	$response = "";
	$tokenization = "";
	$payment = "";
	
	$orders_db->insertRecord(array("id" => $operation_id, "key_public" => $key_public, "key_private" => $key_private, "status" => $status, "data" => json_encode($data), "mediodepago" => 0, "payment_response" => json_encode($response), "payment" => $payment, "tokenization" => $tokenization));

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
	<form id="activeform" method="POST" action="create.php" enctype="multipart/form-data">
		<table id="tablelist" class="full tablesorter">
			<tbody>
				<tr>
			  	   <td><b>Public Key</b></td><td><input type="text" name="key_public" value=""></input></td>
			  	</tr>
				<tr>
			  	   <td><b>Private Key</b></td><td><input type="text" name="key_private" value=""></input></td>
			  	</tr>
				<tr>
				  <td><b>Operacion</b></td><td><input type="text" name="operacion" value="<?php echo "sdk_php".rand(99999,9999999); ?>"></input></td>
				</tr>
				<tr>
				  <td><b>Currency</b></td><td><input type="text" name="currency" value="ARS"></input></td>
				</tr>
				<tr>
				  <td><b>User Id</b></td><td><input type="text" name="user_id" value="pepe"></input></td>
				</tr>
				<tr>
				  <td><b>Cuotas</b></td><td><input type="text" name="cuotas" value="1"></input></td>
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
