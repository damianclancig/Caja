<?php
	include("conexion.php");
	$meses['01']="Enero";
	$meses['1']="Enero";
	$meses['02']="Febrero";
	$meses['2']="Febrero";
	$meses['03']="Marzo";
	$meses['3']="Marzo";
	$meses['04']="Abril";
	$meses['4']="Abril";
	$meses['05']="Mayo";
	$meses['5']="Mayo";
	$meses['06']="Junio";
	$meses['6']="Junio";
	$meses['07']="Julio";
	$meses['7']="Julio";
	$meses['08']="Agosto";
	$meses['8']="Agosto";
	$meses['09']="Septiembre";
	$meses['9']="Septiembre";
	$meses['10']="Octubre";
	$meses['11']="Noviembre";
	$meses['12']="Diciembre";
	$g=0;
?>
<table border="0" cellpadding="0" cellspacing="0">
	<tr class="titulo">
    	<td colspan="21">Resumen</td>
    </tr>
    <tr>
    	<td height="2" bgcolor="#83BCF1" colspan="21"></td>
    </tr>
	<tr class="tah11n">
		<td>Descripcion</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Cuenta</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Cuotas</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Monto</td>
		<td class="colum1"></td>
		<td class="colum2"></td>
		<td class="colum3"></td>
		<td>Total</td>
	</tr>
	<?php
		require("class.sql.php");
		$oSql = new SQLclass();
		$SQL = $oSql->traerCuotas();
		$res2 = mysqli_query($link,$SQL);
		while($row = mysqli_fetch_array($res2))
		{
			include("color2.php");
			if($fecha1!=$row[fecha] AND $flaglin==1)
			{
				?>
				<tr><td bgcolor="#83BCF1" colspan="17" class="tah11n">
					<?php
						$fecha = explode("-",$row[fecha]);
						echo $fecha[2]." de ".$meses[$fecha[1]]." de ".$fecha[0];
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
						echo $fecha[2]." de ".$meses[$fecha[1]]." de ".$fecha[0];
					?>
				</td></tr>
				<?php
			}
			if($usuario!=$row[idadmin])
			{
				?>
				<tr><td bgcolor="#BEDEDE" colspan="17" class="tah11n">
					<?php
						echo $row[nombre];
					?>
				</td></tr>
				<?php
			}
			$usuario=$row[idadmin];
			?>
			<tr <?php echo $color?> onClick="idcaja=<?php echo $row[idcaja]?>; document.getElementById('info').innerHTML='<?php echo $fecha[2]."/".$fecha[1]."/".$fecha[0]." -> ".$row[usuario]." - ".$row[descripcion]?>';">
				<td><?php echo utf8_encode($row[descripcion])?></td>
        <td class="colum1"></td>
        <td class="colum2"></td>
        <td class="colum3"></td>
				<td><?php echo utf8_encode($row[tarjeta])?></td>
        <td class="colum1"></td>
        <td class="colum2"></td>
        <td class="colum3"></td>
				<td><?php echo $row[cuota]." de ".$row[cuotas]?></td>
        <td class="colum1"></td>
        <td class="colum2"></td>
        <td class="colum3"></td>
				<td><?php echo "$ ".(number_format($row[monto]/$row[cuotas],"2",",","."))?></td>
        <td class="colum1"></td>
        <td class="colum2"></td>
        <td class="colum3"></td>
				<td><?php echo "$ ".number_format($row[monto],"2",",",".")?></td>
			</tr>
			<?php
			$fecha1 = $row[fecha];
			$flaglin = 1;
		}
	?>
</table>