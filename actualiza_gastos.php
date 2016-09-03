<?php
	include("conexion.php");
	require("class.sql.php");
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
	$g=0;
?>

<table>
	<tr class="titulo">
		<td width="218">Gastos</td>
		<td width="20" onclick="MostrarOcultar(document.getElementById('TablaGas').style);">-</td>
	</tr>
</table>
<table id="TablaGas">
	<tr><td height="5"></td></tr>
	<?php
		$messel = $_POST["messel"];
		$anosel = $_POST["anosel"];
		if(!isset($messel))
		{
			$messel = date("n");
		}
		if(!isset($anosel))
		{
			$anosel = date("Y");
		}
		$sql = new SQLclass();
		$SQL = $sql->traerGastos($messel, $anosel);
		$res = mysqli_query($link,$SQL);
		$row = mysqli_fetch_array($res);
	?>
	<tr>
		<td colspan="3">
			<table>
				<tr>
					<td class="tah11n">Mes de <?php echo $meses[$messel]?> de <?php echo $anosel?></td>
					<td width="10"></td>
					<td>$ <?php echo number_format($row['monto'],2,",","")?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	<?php
		$SQL = $sql->traerGastosSemanal($messel, $anosel);
		$res = mysqli_query($link,$SQL);
		$row = mysqli_fetch_array($res);
	?>
	<tr>
		<td colspan="3">
			<table>
				<tr class="tah11n">
					<td colspan="7" align="center" bgcolor="#E0F1FF" width="100%">Semanas</td>
				</tr>
				<tr class="tah11n">
					<td width="50">1er</td>
					<td class="colum1"></td>
					<td width="50">2da</td>
					<td class="colum1"></td>
					<td width="50">3ra</td>
					<td class="colum1"></td>
					<td width="50">4ta</td>
				</tr>
				<tr>
					<td>$ <?php echo number_format($row['primera'],2,",","")?></td>
					<td class="colum1"></td>
					<td>$ <?php echo number_format($row['segunda'],2,",","")?></td>
					<td class="colum1"></td>
					<td>$ <?php echo number_format($row['tercera'],2,",","")?></td>
					<td class="colum1"></td>
					<td>$ <?php echo number_format($row['cuarta'],2,",","")?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr><td height="5"></td></tr>
	<?php
		$SQL = $sql->traerGastosAyerHoy($messel, $anosel);
		$res = mysqli_query($link,$SQL);
		$row = mysqli_fetch_array($res);
	?>
	<tr>
		<td>
			<table>
				<tr class="tah11n">
					<td>Ayer</td>
					<td class="colum1"></td>
					<td>Hoy</td>
				</tr>
				<tr>
					<td>$ <?php echo number_format($row['ayer'],2,",","")?></td>
					<td class="colum1"></td>
					<td>$ <?php echo number_format($row['hoy'],2,",","")?></td>
				</tr>
			</table>
		</td>
    <td class="colum1"></td>
		<?php
			$SQL = $sql->traerGastosCuentas($messel, $anosel);
			$res = mysqli_query($link,$SQL);
			$row = mysqli_fetch_array($res);
		?>
		<td>
			<table>
				<tr class="tah11n">
					<td>Efectivo</td>
					<td class="colum1"></td>
					<td>Banco</td>
					<td class="colum1"></td>
					<td>Total</td>
				</tr>
				<tr>
					<td>$ <?php echo number_format($row['efectivo'],2,",","")?></td>
					<td class="colum1"></td>
					<td>$ <?php echo number_format($row['banco'],2,",","")?></td>
					<td class="colum1"></td>
					<td>$ <?php echo number_format($row['efectivo']+$row['banco'],2,",","")?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
