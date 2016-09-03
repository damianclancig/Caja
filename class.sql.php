<?php
	class SQLclass{
		function traerLista($filtroAno,$filtroMes,$filtroUser,$filtroCuenta){
			$condicion = " WHERE ";
			$sql = "SELECT caja.*, cuentas.cuenta, admin.usuario
					FROM caja INNER JOIN cuentas
								ON caja.idcuenta = cuentas.idcuenta
							  INNER JOIN admin
								ON caja.idadmin = admin.idadmin";
			if($filtroAno!=""){
				$sql.= $condicion."YEAR(caja.fecha) = ".$filtroAno;
				$condicion = " AND ";
			}
			if($filtroMes!=""){
				$sql.= $condicion."MONTH(caja.fecha) = ".$filtroMes;
				$condicion = " AND ";
			}
			if($filtroUser!=0){
				$sql.= $condicion."caja.idadmin = ".$filtroUser;
				$condicion = " AND ";
			}
			if($filtroCuenta!=0){
				$sql.= $condicion."caja.idcuenta = '".$filtroCuenta."'";
				$condicion = " AND ";
			}
			$sql.= $condicion."(caja.idcuenta = 1 OR caja.idcuenta = 2) 
					ORDER BY fecha DESC, idadmin";
			return $sql;
		}
		
		function traerCuotas(){
			$sql = "SELECT  caja.idcaja,
							caja.idadmin,
							caja.descripcion,
							caja.fecha,
							PERIOD_DIFF(DATE_FORMAT(CURDATE(), '%Y%m'), DATE_FORMAT(caja.fecha, '%Y%m')) AS cuota,
							caja.cuotas,
							caja.monto,
							tc.tarjeta,
							admin.nombre
					FROM caja	INNER JOIN cuentas
									ON caja.idcuenta = cuentas.idcuenta
								INNER JOIN admin 
									ON caja.idadmin = admin.idadmin
								INNER JOIN tarjetascreditos tc
									ON caja.idtarjeta = tc.idtarjeta
					WHERE DAY(caja.fecha) < tc.diaCorte
					AND (
							PERIOD_DIFF(DATE_FORMAT(CURDATE(), '%Y%m'), DATE_FORMAT(caja.fecha, '%Y%m'))
						) <= caja.cuotas
					AND caja.idcuenta = 3
					UNION
					SELECT  c.idcaja,
							c.idadmin,
							c.descripcion,
							c.fecha,
							PERIOD_DIFF(DATE_FORMAT(CURDATE(), '%Y%m'), DATE_FORMAT(c.fecha, '%Y%m')) - 1 AS cuota,
							c.cuotas,
							c.monto,
							tc2.tarjeta,
							admin.nombre
					FROM caja AS c 	INNER JOIN cuentas
										ON c.idcuenta = cuentas.idcuenta
									INNER JOIN admin
										ON c.idadmin = admin.idadmin
									INNER JOIN tarjetascreditos tc2
										ON c.idTarjeta = tc2.idTarjeta
					WHERE DAY(c.fecha) >= tc2.diaCorte
					AND (
							PERIOD_DIFF(DATE_FORMAT(CURDATE(), '%Y%m'), DATE_FORMAT(c.fecha, '%Y%m')) - 1
						) <= c.cuotas
					AND c.idcuenta =3
					ORDER BY fecha DESC , idadmin";
			return $sql;
		}
		
		function traerActual(){
			$sql = "SELECT admin.nombre, 
							(
								SELECT SUM( c1.monto ) 
								FROM caja AS c1
								WHERE c1.idadmin = cp.idadmin
								AND c1.tipo = 'H'
								AND c1.idcuenta =1
							) - ( 
								SELECT SUM( c2.monto ) 
								FROM caja AS c2
								WHERE c2.idadmin = cp.idadmin
								AND c2.tipo = 'D'
								AND c2.idcuenta =1
							) AS montoE,
							(
								SELECT SUM( c3.monto ) 
								FROM caja AS c3
								WHERE c3.idadmin = cp.idadmin
								AND c3.tipo = 'H'
								AND c3.idcuenta =2
							) - ( 
								SELECT SUM( c4.monto ) 
								FROM caja AS c4
								WHERE c4.idadmin = cp.idadmin
								AND c4.tipo = 'D'
								AND c4.idcuenta =2
							) AS montoB
					FROM caja AS cp
							INNER JOIN admin
								ON cp.idadmin = admin.idadmin
							INNER JOIN cuentas
								ON cp.idcuenta = cuentas.idcuenta
					GROUP BY admin.nombre";
			return $sql;
		}
		
		function traerPlanLargo(){
			$sql = "SELECT (
						(
							SELECT SUM( caja.monto / caja.cuotas ) 
							FROM caja INNER JOIN tarjetascreditos tc
								ON caja.idTarjeta = tc.idTarjeta
							WHERE caja.idadmin = admin.idadmin 
							AND caja.idcuenta =4
							AND caja.cuotas >5
							AND DAY( caja.fecha ) < tc.diaCorte
							AND (PERIOD_DIFF( DATE_FORMAT( CURDATE() , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) +1 ) <= caja.cuotas
						) + ( 
							SELECT SUM( caja.monto / caja.cuotas ) 
							FROM caja INNER JOIN tarjetascreditos tc
								ON caja.idTarjeta = tc.idTarjeta
							WHERE caja.idadmin = admin.idadmin 
							AND caja.idcuenta =4
							AND caja.cuotas >5
							AND DAY( caja.fecha ) >= tc.diaCorte
							AND (PERIOD_DIFF( DATE_FORMAT( CURDATE() , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) ) <= caja.cuotas
						)
					) AS monto
					FROM admin";
			return $sql;
		}
		
		function traerCuotasAcum(){
			$sql = "SELECT admin.nombre,
							(
								SELECT SUM(caja.monto / caja.cuotas)
								FROM caja
								WHERE (
									caja.idadmin = admin.idadmin
									AND caja.idcuenta =4
									AND DAY( caja.fecha ) <20
									AND PERIOD_DIFF( DATE_FORMAT( CURDATE( ) , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) +1 <= caja.cuotas
								) OR (
									caja.idadmin =admin.idadmin
									AND caja.idcuenta =4
									AND DAY( caja.fecha ) >19
									AND PERIOD_DIFF( DATE_FORMAT( CURDATE( ) , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) <= caja.cuotas
									AND PERIOD_DIFF( DATE_FORMAT( CURDATE( ) , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) >0
								)
							) AS montoTS,
							(
								SELECT SUM( caja.monto / caja.cuotas ) 
								FROM caja
								WHERE caja.idadmin = admin.idadmin
								AND caja.idcuenta = 3
								AND PERIOD_DIFF( DATE_FORMAT( CURDATE() , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) <= caja.cuotas
							) AS montoTC
					FROM admin";
			return $sql;
		}
		
		function traerCuotasAcumProx(){
			$sql = "SELECT admin.nombre,
							(
								SELECT SUM(caja.monto / caja.cuotas)
								FROM caja
								WHERE (
									caja.idadmin = admin.idadmin
									AND caja.idcuenta =4
									AND DAY( caja.fecha ) <20
									AND PERIOD_DIFF( DATE_FORMAT( CURDATE( ) , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' )) +2 <= caja.cuotas
								)
								OR (
									caja.idadmin =admin.idadmin
									AND caja.idcuenta =4
									AND DAY( caja.fecha ) >19
									AND PERIOD_DIFF( DATE_FORMAT( CURDATE( ) , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) )+1 <= caja.cuotas
									AND PERIOD_DIFF( DATE_FORMAT( CURDATE( ) , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) )+1 >0
								)
							) AS montoTS,
							(
								SELECT SUM( caja.monto / caja.cuotas ) 
								FROM caja
								WHERE caja.idadmin = admin.idadmin
								AND caja.idcuenta = 3
								AND PERIOD_DIFF( DATE_FORMAT( CURDATE() , '%Y%m' ) , DATE_FORMAT( caja.fecha, '%Y%m' ) ) <= caja.cuotas
							) AS montoTC
					FROM admin";
			return $sql;
		}
		
		function traerGastos($messel, $anosel){
			$sql = "SELECT SUM(monto) AS monto
							FROM caja
							WHERE MONTH(fecha) = ".$messel."
							AND YEAR(fecha) = ".$anosel."
							AND tipo = 'D'
							AND caja.idcuenta <> 3
							AND caja.idcuenta <> 4
							AND caja.descripcion <> 'Extraccion'
							GROUP BY tipo";
			return $sql;
		}
		
		function traerGastosSemanal($messel, $anosel){
			$sql = "SELECT 	sum( (
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND DAY( c.fecha ) <8 
											)	) AS primera,
											sum( (
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND DAY( c.fecha ) >7
												AND DAY( c.fecha ) <15
											)	) AS segunda,
											sum( (
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND DAY( c.fecha ) >14
												AND DAY( c.fecha ) <22
											)	) AS tercera,
											sum( (
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND DAY( c.fecha ) >21
											)	) AS cuarta
							FROM caja
							WHERE caja.tipo = 'D'
							AND MONTH( caja.fecha ) =1
							AND YEAR( caja.fecha ) =2008
							AND (
								caja.idcuenta =1
								OR caja.idcuenta =2
							)";
			return $sql;
		}
		
		function traerGastosAyerHoy($messel, $anosel){
			$sql = "SELECT 	sum( (
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND DAY( c.fecha ) = DAY( DATE_SUB( CURDATE( ) , INTERVAL 1 
												DAY ) ) ) 
											) AS ayer,
											sum( (
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND DAY( c.fecha ) = DAY( CURDATE( ) ) ) 
											) AS hoy
							FROM caja
							WHERE caja.tipo = 'D'
							AND MONTH( caja.fecha ) =".$messel."
							AND YEAR( caja.fecha ) =".$anosel."
							AND (
								caja.idcuenta =1
								OR caja.idcuenta =2
							)";
			return $sql;
		}
		
		function traerGastosCuentas($messel, $anosel){
			$sql = "SELECT 	sum((
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND c.idcuenta =1 ) 
												) AS efectivo,
											sum((
												SELECT c.monto
												FROM caja AS c
												WHERE c.idcaja = caja.idcaja
												AND c.idcuenta =2 ) 
											) AS banco
							FROM caja
							WHERE caja.tipo = 'D'
							AND MONTH( caja.fecha ) =".$messel."
							AND YEAR( caja.fecha ) =".$anosel."";
			return $sql;
		}
	}
?>