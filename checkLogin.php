<?php
	session_start();
	
	$host_db = "localhost";
	$user_db = "administrador";
	$pass_db = "techadministrator";
	$db_name = "caja";
	$tbl_name = "admin";
	
	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
	
	if ($conexion->connect_error) {
		die("La conexion falló: " . $conexion->connect_error);
	}
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM $tbl_name WHERE usuario = '$username'";
	
	$result = $conexion->query($sql);
	
	if ($result->num_rows > 0) {
	}
	$row = $result->fetch_array(MYSQLI_ASSOC);
	//if (password_verify($password, $row['clave'])) {
	if ($password == $row['clave']) {
		
	    $_SESSION['loggedin'] = true;
	    $_SESSION['username'] = $username;
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
		
	    header('Location: index.php');
// 	    echo "Bienvenido! " . $_SESSION['username'];
// 	    echo "<br><br><a href=index.php>Continuar</a>"; 
		
	} else { 
		echo "Username o Password estan incorrectos.";
		echo "<br><a href='login.php'>Volver a Intentarlo</a>";
	}
 	mysqli_close($conexion); 
 ?>