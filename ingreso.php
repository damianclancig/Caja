<?php
  function authenticate()
	{
		header('WWW-Authenticate: Basic realm="Ingreso a Sistema Imantec"');
		header('HTTP/1.0 401 Unauthorized');
		include("ingreso1.php");
		exit;
  }
  if (!isset($_SERVER['PHP_AUTH_USER']) || ($_POST['SeenBefore'] == 1 && $_POST['OldAuth'] == $_SERVER['PHP_AUTH_USER']))
	{
		authenticate();
  } 
  else
	{
		$ingreso = "no";
		while($ingreso!="si")
		{
			$result = mysqli_query($link, "SELECT * FROM admin");
			while($row = mysqli_fetch_array($result))
			{
				if($_SERVER['PHP_AUTH_USER']==$row[usuario]&&$_SERVER['PHP_AUTH_PW']==$row[clave])
				{
					$ingreso = "si";
					$user = $row[idadmin];
				}
			}
			if($ingreso!="si")
			{
				authenticate();
			}
		}
  }
?>