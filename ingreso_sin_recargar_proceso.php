<?php
	session_start();
	include("conexion.php");
	$idadmin = $_SESSION['username'];
	$descripcion = $_POST["descripcion"];
	$anio = $_POST["anio"];
	$mes = $_POST["mes"];
	$dia = $_POST["dia"];
	$cuenta = $_POST["cuenta"];
	$tarjeta = $_POST["tarjeta"];
	$cuotas = $_POST["cuotas"];
	$tipo = $_POST["tipo"];
	$monto = $_POST["monto"];
	
	$sql = "";
	$sql2 = "";
	if($cuenta=="1" or $cuenta=="2"){
		$sql = "INSERT INTO caja (idcaja, idadmin, descripcion, fecha, idcuenta, idtarjeta, cuotas, tipo, monto)
								 VALUES ('', '".$idadmin."', '".$descripcion."', '".$anio."-".$mes."-".$dia."', '".$cuenta."', '0', '0', '".$tipo."', '".$monto."')";
	}
	elseif($cuenta=="3"){
		$sql = "INSERT INTO caja (idcaja, idadmin, descripcion, fecha, idcuenta, idtarjeta, cuotas, tipo, monto)
								 VALUES ('', '".$idadmin."', '".$descripcion."', '".$anio."-".$mes."-".$dia."', '".$cuenta."', '".$tarjeta."', '".$cuotas."', 'D', '".$monto."')";
	}
	elseif($cuenta=="5"){
		$sql = "INSERT INTO caja (idcaja, idadmin, descripcion, fecha, idcuenta, tipo, monto)
								 VALUES ('', '".$idadmin."', '".$descripcion."', '".$anio."-".$mes."-".$dia."', '1', 'D', '".$monto."')";
		$sql2 = "INSERT INTO caja (idcaja, idadmin, descripcion, fecha, idcuenta, tipo, monto)
								 VALUES ('', '".$idadmin."', '".$descripcion."', '".$anio."-".$mes."-".$dia."', '".$cuenta."', 'H', '".$monto."')";
	}
	elseif($cuenta=="6"){
		$sql = "INSERT INTO caja (idcaja, idadmin, descripcion, fecha, idcuenta, tipo, monto)
								 VALUES ('', '".$idadmin."', '".$descripcion."', '".$anio."-".$mes."-".$dia."', '1', 'H', '".$monto."')";
		$sql2 = "INSERT INTO caja (idcaja, idadmin, descripcion, fecha, idcuenta, tipo, monto)
								 VALUES ('', '".$idadmin."', '".$descripcion."', '".$anio."-".$mes."-".$dia."', '2', 'D', '".$monto."')";
	}
	echo $sql;
	mysqli_query($link,$sql);
	if($sql2 != ""){
		mysqli_query($link,$sql2);
	}
	mysqli_close($link);
?>