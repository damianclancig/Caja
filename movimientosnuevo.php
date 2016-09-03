<?php
	include("coneccion.php");
	include("ingreso.php");
	if($ingreso=="si")
	{
		/*--------------*/
		if($opcion=="agregar")
		{
			mysqli_query($link,"INSERT INTO caja (idcaja, descripcion, fecha, tipo, monto) VALUES ('', '".$descripcion."', '".$año."-".$mes."-".$dia."', '".$tipo."', '".$monto."')");
		}
		/*--------------*/
		include ("menu.php");
		/*--------------*/
		?>
		<script>document.getElementById('nuevo').style.backgroundColor='#3876CB'</script>
		<table border="1" cellpadding="0" cellspacing="0" width="500" height="100" background="thumb.php?image=imagenes/interfaz_fondo.jpg&w=14" class="tah11">
			<form method="post" name="caja">
				<tr>
					<td>
						<table border="0" cellpadding="0" cellspacing="0" align="center">
							<tr>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>Fecha</td>
										</tr>
										<tr>
											<td><?php include("fecha.php")?></td>
										</tr>
									</table>
								</td>
								<td width="10"></td>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>Descripción</td>
										</tr>
										<tr>
											<td><input type="text" name="descripcion" class="tah11"></td>
										</tr>
									</table>
								</td>
								<td width="10"></td>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>Tipo</td>
										</tr>
										<tr>
											<td>
												<select name="tipo" class="tah11">
													<option value="H">Haber</option>
													<option value="D">Debe</option>
												</select>
											</td>
										</tr>
									</table>
								</td>
								<td width="10"></td>
								<td>
									<table border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td>Monto</td>
										</tr>
										<tr>
											<td><input type="text" name="monto" class="tah11"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td height="5"></td></tr>
							<tr>
								<td colspan="7" align="right"><input type="button" value="Aceptar" class="tah11" onClick="if(document.caja.descripcion.value=='')
																																																												{
																																																													alert('Debe Comletar la Descripcion');
																																																													document.caja.descripcion.focus();
																																																												}
																																																												else if(document.caja.monto.value=='')
																																																												{
																																																													alert('Debe Completar el Monto')
																																																													document.caja.monto.focus();
																																																												}
																																																												else
																																																												{
																																																													Accion('agregar');
																																																												}"></td>
							</tr>
						</table>
					</td>
				</tr>
				<input type="hidden" name="opcion">
			</form>
		</table>
		<?php
		/*--------------*/
		?>
		</body>
		</html>
		<?php
	}
	mysqli_close($link);
?>