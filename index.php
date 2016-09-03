<?php
	include("checkSession.php");
	include("conexion.php");
// 	$g = 0;
	include 'variables.php';
	?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sistema de Caja</title>
		<link rel="stylesheet" type="text/css" href="estilos.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
		<script type="text/javascript" src="funciones.js"></script>
	</head>
	<body id="body">
		<div id="selector">
			<div id="info">Seleccione un registro.</div>
			<div id="Beliminar">
				<img id="imgEliminar" src="imagenes/eliminar.jpg">
			</div>
			<div id="Brenovar">
				<img id="imgRenovar" src="imagenes/renovar.jpg">
			</div>
		</div>
		<div id="herramientas">
			<div id="herr">
				<div id="Dfecha">
					<table>
						<tr>
							<td>Fecha</td>
						</tr>
						<tr>
							<td><select id="dia" class="tah11"></select> <select id="mes"
								class="tah11"></select> <select id="anio" class="tah11"></select>
							</td>
						</tr>
					</table>
				</div>
				<div id="Ddescripcion">
					<table>
						<tr>
							<td>Descripci&oacute;n</td>
						</tr>
						<tr>
							<td><input type="text" id="descripcion" class="tah11"></td>
						</tr>
					</table>
				</div>
				<div id="Dcuenta">
					<table>
						<tr>
							<td>Cuenta</td>
						</tr>
						<tr>
							<td>
								<select id="cuenta" name="cuenta" class="tah11">
									<?php
									$res1 = mysqli_query ( $link, "SELECT * FROM cuentas" );
									while ( $row1 = mysqli_fetch_assoc ( $res1 ) ) {
										if ($cuentasel == $row1['idcuenta']) {
											?>
											<option value='<? echo $row1['idcuenta']?>' selected><?php echo $row1['cuenta']?></option>
											<?php
										} else {
											?>
											<option value='<?php echo $row1['idcuenta']?>'><?php echo $row1['cuenta']?></option>
											<?php
										}
									}
									?>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="Dtarjeta">
					<table>
						<tr>
							<td>Tarjeta</td>
						</tr>
						<tr>
							<td>
								<select id="tarjeta" name="tarjeta" class="tah11">
									<?php
									$res1 = mysqli_query ( $link, "SELECT * FROM tarjetascreditos" );
									while ( $row1 = mysqli_fetch_assoc ( $res1 ) ) {
										if ($tarjetasel == $row1 ['idTarjeta']) {
											?>
											<option value="<?php echo $row1['idTarjeta']?>" selected><?php echo $row1['tarjeta']?></option>
											<?php
										} else {
											?>
											<option value="<?php echo $row1['idTarjeta']?>"><?php echo $row1['tarjeta']?></option>
											<?php
										}
									}
									?>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="Dcuotas">
					<table>
						<tr>
							<td>Cuotas</td>
						</tr>
						<tr>
							<td>
								<select id="cuotas" class="tah11">
									<?php
									for($i = 1; $i < 51; $i ++) {
										?>
										<option value="<?php echo $i?>"><?php echo $i?></option>
										<?php
									}
									?>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="Dtipo">
					<table>
						<tr>
							<td>Tipo</td>
						</tr>
						<tr>
							<td>
								<select id="tipo" class="tah11">
									<option value="D">D&eacute;bito</option>
									<option value="H">Cr&eacute;dito</option>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div id="Dmonto">
					<table>
						<tr>
							<td>Monto</td>
						</tr>
						<tr>
							<td><input type="text" id="monto" class="tah11"></td>
						</tr>
					</table>
				</div>
				<div id="Bguardar">
					<img id="imgGuardar" src="imagenes/guardar.jpg">
				</div>
				<input type="hidden" id="user1" value="<?php echo $user?>">
			</div>
			<div id="MsjError" style="display: none"></div>
		</div>
		<div id="scroll">
			<div id="FilFec">
				<?php
				if (! isset ( $messel )) {
					$messel = date ( "n" );
				}
				if (! isset ( $anosel )) {
					$anosel = date ( "Y" );
				}
				?>
				<table class="tah11">
					<tr>
						<td width="10"></td>
						<td>
							<select id="filmes" class="tah11">
								<option value='<?php echo date("n")?>'>Mes</option>
							</select>
						</td>
						<td>
							<select id="filanio" class="tah11">
								<option value='<?php echo date("Y")?>'>A&ntilde;o</option>
							</select>
						</td>
						<td>
							<select id="filuser" class="tah11" onChange=>
								<option value="0" selected>Usuario</option>
								<?php
								$res1 = mysqli_query ( $link, "SELECT idadmin, usuario FROM admin" );
								while ( $row1 = mysqli_fetch_assoc ( $res1 ) ) {
									if ($usersel == $row1 ['idadmin']) {
										?>
										<option value="<?php echo $row1['idadmin']?>" selected><?php echo $row1['usuario']?></option>
										<?php
									} else {
										?>
										<option value="<?php echo $row1['idadmin']?>"><?php echo $row1['usuario']?></option>
										<?php
									}
								}
								?>
							</select>
						</td>
						<td>
							<select id="filcuenta" class="tah11">
								<option value="0" selected>Cuenta</option>
								<?php
								$res1 = mysqli_query ( $link, "SELECT * FROM cuentas" );
								while ( $row1 = mysqli_fetch_assoc ( $res1 ) ) {
									if ($cuentasel == $row1 ['idcuenta']) {
										?>
										<option value="<?php echo $row1['idcuenta']?>" selected><?php echo $row1['cuenta']?></option>
										<?php
									} else {
										?>
										<option value="<?php echo $row1['idcuenta']?>"><?php echo $row1['cuenta']?></option>
										<?php
									}
								}
								?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div id="scroll2">
				<table class="tah11 fondoBlanco">
					<tr>
						<td class="borIzqSup"></td>
						<td class="borSup"></td>
						<td class="borDerSup"></td>
					</tr>
					<tr>
						<td class="borIzq"></td>
						<td id="Lista"></td>
						<td class="borDer"></td>
					</tr>
					<tr>
						<td class="borIzqInf"></td>
						<td class="borInf"></td>
						<td class="borDerInf"></td>
					</tr>
				</table>
			</div>
			<div id="DListaC">
				<table class="tah11 fondoBlanco">
					<tr>
						<td class="borIzqSup"></td>
						<td class="borSup"></td>
						<td class="borDerSup"></td>
					</tr>
					<tr>
						<td class="borIzq"></td>
						<td id="ListaC"></td>
						<td class="borDer"></td>
					</tr>
					<tr>
						<td class="borIzqInf"></td>
						<td class="borInf"></td>
						<td class="borDerInf"></td>
					</tr>
				</table>
			</div>
			<div id="DListaAct">
				<table class="tah11 fondoBlanco">
					<tr>
						<td class="borIzqSup"></td>
						<td class="borSup"></td>
						<td class="borDerSup"></td>
					</tr>
					<tr>
						<td class="borIzq"></td>
						<td id="ListaAct"></td>
						<td class="borDer"></td>
					</tr>
					<tr>
						<td class="borIzqInf"></td>
						<td class="borInf"></td>
						<td class="borDerInf"></td>
					</tr>
				</table>
			</div>
			<div id="DListaGas">
				<table class="tah11 fondoBlanco">
					<tr>
						<td class="borIzqSup"></td>
						<td class="borSup"></td>
						<td class="borDerSup"></td>
					</tr>
					<tr>
						<td class="borIzq"></td>
						<td id="ListaGas"></td>
						<td class="borDer"></td>
					</tr>
					<tr>
						<td class="borIzqInf"></td>
						<td class="borInf"></td>
						<td class="borDerInf"></td>
					</tr>
				</table>
			</div>
			<div id="DCuotasAcu">
				<table class="tah11 fondoBlanco">
					<tr>
						<td class="borIzqSup"></td>
						<td class="borSup"></td>
						<td class="borDerSup"></td>
					</tr>
					<tr>
						<td class="borIzq"></td>
						<td id="CuotasAcu"></td>
						<td class="borDer"></td>
					</tr>
					<tr>
						<td class="borIzqInf"></td>
						<td class="borInf"></td>
						<td class="borDerInf"></td>
					</tr>
				</table>
			</div>
		</div>
		<div id="Dfooter">Sistema creado por Clancig, Dami&aacute;n (2007). Powered By PHP &amp; MySQL with AJAX</div>
	</body>
</html>
	<?php
mysqli_close($link);
?>
