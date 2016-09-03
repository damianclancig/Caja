<?php
	include("conexion.php");
	$meses[1]="Enero";
	$meses[2]="Febrero";
	$meses[3]="Marzo";
	$meses[4]="Abril";
	$meses[5]="Mayo";
	$meses[6]="Junio";
	$meses[7]="Julio";
	$meses[8]="Agosto";
	$meses[9]="Septiembre";
	$meses[10]="Octubre";
	$meses[11]="Noviembre";
	$meses[12]="Diciembre";
	require("class.sql.php");
	$sql = new SQLclass();
	$SQL = $sql->traerActual();
	$res = mysqli_query($link,$SQL);
?>
<table border="0" cellpadding="0" cellspacing="0">
	<tr class="titulo">
		<td width="208px">Actual</td>
		<td width="20px" onclick="MostrarOcultar(document.getElementById('TablaAct').style);">-</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" id="TablaAct">
	<tr><td height="5"></td></tr>
	<tr>
		<td></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td class="tah11n">Efectivo</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td class="tah11n">Banco</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td class="tah11n">Total</td>
	</tr>
	<?php
		while($row = mysqli_fetch_array($res)){
			?>
			<tr>
				<td class="tah11n"><?php echo $row[nombre]?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row[montoE],2,",","")?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row[montoB],2,",","")?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row[montoB]+$row[montoE],2,",","")?></td>
			</tr>
			<?php
			$efectivo += $row[montoE];
			$banco += $row[montoB];
		}
	?>
	<tr>
		<td class="tah11n">Total</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($efectivo,2,",","")?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($banco,2,",","")?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($banco+$efectivo,2,",","")?></td>
	</tr>
</table>