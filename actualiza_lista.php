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
	$g=0;
?>
<table border="0" cellpadding="0" cellspacing="0">
	<tr class="tah11n">
		<td>Descripcion</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Cuenta</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Debito</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Credito</td>
	</tr>
	<?php
		$messel = $_POST["messel"];
		$anosel = $_POST["anosel"];
		$usersel = $_POST["usersel"];
		$cuentasel = $_POST["cuentasel"];
		if(!isset($messel))
		{
			$messel = date("n");
		}
		if(!isset($anosel))
		{
			$anosel = date("Y");
		}
		require("class.sql.php");
		$sql = new SQLclass();
		$SQL = $sql->traerLista($anosel,$messel,$usersel,$cuentasel);
		$result = mysqli_query($link,$SQL);
		while($row = mysqli_fetch_array($result)){
			include("color.php");
			if($fecha1!=$row[fecha] AND $flaglin==1)
			{
				?>
				<tr><td bgcolor="#83BCF1" colspan="17" class="tah11n">
					<?php
						$fecha = explode("-",$row[fecha]);
						echo $fecha[2]." de ".$meses[intval($fecha[1])]." de ".$fecha[0];
					?>
				</td></tr>
				<?php
				$usuario="";
			}
			elseif($flaglin!=1)
			{
				?>
				<tr><td bgcolor="#83BCF1" colspan="17" class="tah11n">
					<?php
						$fecha = explode("-",$row[fecha]);
						echo $fecha[2]." de ".$meses[intval($fecha[1])]." de ".$fecha[0];
					?>
				</td></tr>
				<?php
			}
			if($usuario!=$row[idadmin])
			{
				?>
				<tr><td bgcolor="#BEDEDE" colspan="17" class="tah11n">
					<?php
						echo $row[usuario];
					?>
				</td></tr>
				<?php
			}
			$usuario=$row[idadmin];
			?>
			<tr <?php echo $color?> onClick="idcaja=<?php echo $row[idcaja]?>; document.getElementById('info').innerHTML='<?php echo $fecha[2]."/".$fecha[1]."/".$fecha[0]." -> ".$row[usuario]." - ".$row[descripcion]." -> ".$row[cuenta]?>';">
				<td><?php echo utf8_encode($row[descripcion])?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
				<td><?php echo utf8_encode($row[cuenta])?></td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
				<td>
					<?php
						if($row[tipo]=="D")
						{
							echo "$ ".number_format($row[monto],"2",",",".");
						}
					?>
				</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
				<td>
					<?php
						if($row[tipo]=="H")
						{
							echo "$ ".number_format($row[monto],"2",",",".");
						}
					?>
				</td>
			</tr>
			<?php
			$fecha1 = $row[fecha];
			$flaglin = 1;
		}
	?>
</table>
