<?php
	$link = mysqli_connect("localhost", "administrador", "techadministrator", "caja");
//	$base = "u861074671_caja";
//	mysqli_select_db($base, $link);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>