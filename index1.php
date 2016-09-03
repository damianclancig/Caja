<?php
	include("coneccion.php");
	include("ingreso.php");
	if($ingreso=="si")
	{
		/*--------------*/
		header("Location: movimientoslistado.php");
		/*--------------*/
		include ("menu.php");
		/*--------------*/
		/*--------------*/
		?>
		</body>
		</html>
		<?php
	}
	mysqli_close($link);
?>