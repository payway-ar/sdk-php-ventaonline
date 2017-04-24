<?php

var_dump($_POST);

?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<title>Administrador</title>
	        <!-- Le styles -->
		<link href="css/styles.css" media="screen" rel="stylesheet" type="text/css">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.js" integrity="sha256-tA8y0XqiwnpwmOIl3SGAcFl2RvxHjA8qp0+1uCGmRmg=" crossorigin="anonymous"></script>
	</head>
	<body>	
		<form id="activeform" method="POST" action="test.php" enctype="multipart/form-data">
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
			  <td><b>Monto</b></td><td><input type="text" name="monto" value="50.00"></input></td>
			</tr>
		</form>
		<tfoot>
		  <tr>
			<td colspan="2"><a href="index.php" class="btn error site">Cancelar</a>&nbsp;&nbsp;&nbsp;<a href="test.php" onclick="$('#activeform').submit();return false;" class="btn site" id="send">Enviar</a></td>
		  </tr>
		</tfoot>
	</body>
</html>