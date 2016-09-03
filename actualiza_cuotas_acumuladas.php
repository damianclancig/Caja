<?php
	include("checkSession.php");
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
	$totalTC = 0;
	$totalTS = 0;
?>
<table border="0" cellpadding="0" cellspacing="0">
	<tr class="titulo">
		<td width="216">Cuotas Acumuladas</td>
		<td width="20" onclick="MostrarOcultar(document.getElementById('TablaCuoAcu').style)">-</td>
	</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" id="TablaCuoAcu">
	<tr><td height="5"></td></tr>
	<?php
		$sql = new SQLclass();
		$SQL = $sql->traerPlanLargo();
		$res = mysqli_query($link,$SQL);
		$row = mysqli_fetch_array($res);
	?>
    <tr>
        <td colspan="13">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td class="tah11n">Suma de Cuotas Plan largo</td>
                    <td class="colum1"></td>
                    <td class="tah11"><?php echo "$ ".number_format($row['monto'],2,",","")?></td>
                </tr>
            </table>
        </td>
    </tr>
	<tr><td height="5"></td></tr>
	<?php
		$SQL = $sql->traerCuotasAcum();
		$res = mysqli_query($link,$SQL);
		?>
		<tr>
			<td colspan="13">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="tah11n">Mes de <?php echo $meses[date("n")+1>12?1:date("n")+1]?> de <?php echo date("n")+1>12?date("Y")+1:date("Y")?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="colum1"></td>
			<td class="colum2"></td>
			<td class="colum3"></td>
			<td class="tah11n">T. Credito</td>
			<td class="colum1"></td>
			<td class="colum2"></td>
			<td class="colum3"></td>
			<td class="tah11n">T. Shopping</td>
			<td class="colum1"></td>
			<td class="colum2"></td>
			<td class="colum3"></td>
			<td class="tah11n">Total</td>
		</tr>
		<?php
		while($row = mysqli_fetch_array($res)){
			?>
			<tr bgcolor="#E0F1FF">
				<td class="tah11n"><?php echo $row['nombre']?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row['montoTC'],2,",","")?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row['montoTS'],2,",","")?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row['montoTC']+$row['montoTS'],2,",","")?></td>
			</tr>
			<?php
			$totalTC += $row['montoTC'];
			$totalTS += $row['montoTS'];
		}
	?>
	<tr bgcolor="#E0F1FF">
		<td class="tah11n">Total</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($totalTC,2,",","")?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($totalTS,2,",","")?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td style="color:#FF0000"><?php echo "$ ".number_format($totalTC+$totalTS,2,",","")?></td>
	</tr>
	<?php
		$SQL = $sql->traerCuotasAcumProx();
		$res = mysqli_query($link,$SQL);
	?>
		<tr>
			<td colspan="13" height="10"></td>
		</tr>
		<tr>
			<td colspan="13">
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td class="tah11n">Mes de <?php echo $meses[date("n")+2>12?date("n")-10:date("n")+1]?> de <?php echo  date("n")+2>12?date("Y")+1:date("Y");?></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td></td>
			<td class="colum1"></td>
			<td class="colum2"></td>
			<td class="colum3"></td>
			<td class="tah11n">T. Credito</td>
			<td class="colum1"></td>
			<td class="colum2"></td>
			<td class="colum3"></td>
			<td class="tah11n">T. Shopping</td>
			<td class="colum1"></td>
			<td class="colum2"></td>
			<td class="colum3"></td>
			<td class="tah11n">Total</td>
		</tr>
		<?php
		$totalTC = $totalTS = 0;
		while($row = mysqli_fetch_array($res)){
			?>
			<tr bgcolor="#E0F1FF">
				<td class="tah11n"><?php echo $row['nombre']?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row['montoTC'],2,",","")?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row['montoTS'],2,",","")?></td>
				<td class="colum1"></td>
				<td class="colum2"></td>
				<td class="colum3"></td>
				<td><?php echo "$ ".number_format($row['montoTC']+$row['montoTS'],2,",","")?></td>
			</tr>
			<?php
			$totalTC += $row['montoTC'];
			$totalTS += $row['montoTS'];
		}
	?>
	<tr bgcolor="#E0F1FF">
		<td class="tah11n">Total</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($totalTC,2,",","")?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td><?php echo "$ ".number_format($totalTS,2,",","")?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td style="color:#FF0000"><?php echo "$ ".number_format($totalTC+$totalTS,2,",","")?></td>
	</tr>
</table>