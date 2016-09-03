<?php
	include("coneccion.php");
	include("ingreso.php");
	if($ingreso == "si")
	{
		$g = 0;
		?>
		<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
		<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
			<title>Sistema de Caja</title>
		  <link rel="stylesheet" href="estilos1024.css" type="text/css">
			<script language="JavaScript" src="jquery-1.11.2.min.js" type="text/javascript"></script>
			<script language="JavaScript" src="funciones.js" type="text/javascript"></script>
		</head>
		<body id="body">
	    <div id="selector">
	    	<div id="info">Seleccione un registro.</div>
	      <div id="Beliminar"><img id="imgEliminar" src="imagenes/eliminar.jpg"></div>
				<div id="Brenovar"><img id="imgRenovar" src="imagenes/renovar.jpg"></div>
	      <div id="est">
          <select id="estilo" class="tah11">
            <option value="800">800</option>
            <option value="1024">1024</option>
            <option value="1152">1152</option>
            <option value="1280">1280</option>
            <option value="1440">1440</option>
            <option value="1600">1600</option>
          </select>
	      </div>
	    </div>
	    <div id="herramientas">
		    <div id="herr">
          <div id="Dfecha">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>Fecha</td>
              </tr>
              <tr>
                <td>
                  <select id="dia" class="tah11"></select>
                  <select id="mes" class="tah11"></select>
                  <select id="anio" class="tah11"></select>
                </td>
              </tr>
            </table>
          </div>
          <div id="Ddescripcion">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>Descripci&oacute;n</td>
              </tr>
              <tr>
                <td><input type="text" id="descripcion" class="tah11"></td>
              </tr>
            </table>
          </div>
          <div id="Dcuenta">
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>Cuenta</td>
              </tr>
              <tr>
                <td>
                  <select id="cuenta" name="cuenta" class="tah11">
                    <?php
                      $res1 = mysqli_query($link,"SELECT * FROM cuentas");
                      while($row1 = mysqli_fetch_array($res1))
                      {
                        if($cuentasel==$row1[idcuenta])
                        {
                          ?>
                          <option value='<? echo $row1[idcuenta]?>' selected><?php echo $row1[cuenta]?></option>
                          <?php
                        }
                        else
                        {
                          ?>
                          <option value='<?php echo $row1[idcuenta]?>'><?php echo $row1[cuenta]?></option>
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
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>Tarjeta</td>
              </tr>
              <tr>
                <td>
                  <select id="tarjeta" name="tarjeta" class="tah11">
                    <?php
                      $res1 = mysqli_query($link,"SELECT * FROM tarjetascreditos");
                      while($row1 = mysqli_fetch_array($res1))
                      {
                        if($tarjetasel==$row1[idTarjeta])
                        {
                          ?>
                          <option value="<?php echo $row1[idTarjeta]?>" selected><?php echo $row1[tarjeta]?></option>
                          <?php
                        }
                        else
                        {
                          ?>
                          <option value="<?php echo $row1[idTarjeta]?>"><?php echo $row1[tarjeta]?></option>
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
            <table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td>Cuotas</td>
              </tr>
              <tr>
                <td>
                  <select id="cuotas" class="tah11">
					<?php
                        for($i=1;$i<51;$i++){
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
            <table border="0" cellpadding="0" cellspacing="0">
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
            <table border="0" cellpadding="0" cellspacing="0">
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
				<div id="MsjError" style="display:none"></div>
			</div>
			<div id="scroll">
	    	<div id="FilFec">
					<?php
	          if(!isset($messel))
	          {
	            $messel = date("n");
	          }
	          if(!isset($anosel))
	          {
	            $anosel = date("Y");
	          }
	        ?>
          <table border="0" cellpadding="0" cellspacing="0" class="tah11">
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
                    $res1 = mysqli_query($link,"SELECT idadmin, usuario FROM admin");
                    while($row1 = mysqli_fetch_array($res1))
                    {
                      if($usersel==$row1[idadmin])
                      {
                        ?>
                        <option value="<?php echo $row1[idadmin]?>" selected><?php echo $row1[usuario]?></option>
                        <?php
                      }
                      else
                      {
                        ?>
                        <option value="<?php echo $row1[idadmin]?>"><?php echo $row1[usuario]?></option>
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
                    $res1 = mysqli_query($link,"SELECT * FROM cuentas");
                    while($row1 = mysqli_fetch_array($res1))
                    {
                      if($cuentasel==$row1[idcuenta])
                      {
                        ?>
                        <option value="<?php echo $row1[idcuenta]?>" selected><?php echo $row1[cuenta]?></option>
                        <?php
                      }
                      else
                      {
                        ?>
                        <option value="<?php echo $row1[idcuenta]?>"><?php echo $row1[cuenta]?></option>
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
	        <table border="0" cellpadding="0" cellspacing="0" class="tah11" bgcolor="#FFFFFF">
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
	        <table border="0" cellpadding="0" cellspacing="0" class="tah11" bgcolor="#FFFFFF">
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
	        <table border="0" cellpadding="0" cellspacing="0" class="tah11" bgcolor="#FFFFFF" onmousedown="dragStart(event, 'DListaAct')">
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
	        <table border="0" cellpadding="0" cellspacing="0" class="tah11" bgcolor="#FFFFFF" onmousedown="dragStart(event, 'DListaGas')">
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
	        <table border="0" cellpadding="0" cellspacing="0" class="tah11" bgcolor="#FFFFFF" onmousedown="dragStart(event, 'DCuotasAcu')">
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
	}
	mysqli_close($link);
?>
