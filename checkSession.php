<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	} else {
		header('Location: login.php');
// 		echo "Esta pagina es solo para usuarios registrados.<br>";
// 		echo "<br><a href='login.php'>Login</a>";
		exit;
	}
	$now = time();
	if($now > $_SESSION['expire']) {
		session_destroy();
		header('Location: login.php');
		exit;
	}
	else{
		$_SESSION['start'] = time();
		$_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
	}
?>