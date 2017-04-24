<?php
include_once dirname(__FILE__)."/FlatDb.php";

$orders_db = new FlatDb();
if(!file_exists("ordenes.tsv"))
	$orders_db->createTable('ordenes',array("id","key_public","key_private","status","data","mediodepago", "payment_response", "payment","tokenization"));

$orders_db->openTable('ordenes');
$ord = $orders_db->getRecords(array("id","key_public","key_private","status","data","mediodepago", "payment_response", "payment", "tokenization"));

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
		<tr>
			<th class="header">Operacion</th>
			<th class="header">Estado</th>
			<th class="header">Medio de Pago</th>
			<th class="header">Pago</th>
			<th class="header">Estado del Pago</th>
			<th class="header">Anular / Devolver</th>
		</tr>
	</thead>
	<tbody><?php foreach($ord as $o): ?>
    	<tr>
      		<td><?php echo $o['id'];?></td>
      		<td><?php echo $o['status'];?></td>
			<td>
				<?php  if($o['mediodepago'] == 0){ ?>
					<a href="mediopago.php?ord=<?php echo $o['id'];?>" class="btn site btn-sm">Agregar datos de Medio de Pago</a>
				<?php }else{ echo $o['mediodepago']; }?>
			</td>
			<td><?php if($o['payment'] == 0){ ?>
				<a href="pagar.php?ord=<?php echo $o['id'];?>" class="btn site btn-sm">Pagar</a></td>
				<?php }else{ echo $o['payment']; }?>
			<td><a href="status.php?ord=<?php echo $o['id'];?>" class="btn success btn-sm">Consultar Estado</a></td>
       		<td>
       			<a href="devolver.php?ord=<?php echo $o['id'];?>" class="btn warning site btn-sm">Devolver</a>
       		</td>
      	</tr>
		<?php endforeach;?>
	</tbody>
		<tfoot>
	  <tr>
	    <td colspan="7"><a href="create.php" class="btn info">Nuevo</a></td>
	  </tr>
	</tfoot>
		</table>
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
