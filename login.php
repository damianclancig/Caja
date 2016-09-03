<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<meta charset="utf-8">
	</head>

	<body>
		<h1>Login de Usuarios</h1>
		<hr />
		<form action="checkLogin.php" method="post" >
			<label>Nombre Usuario:</label><br>
			<input name="username" type="text" id="username" required>
			<br><br>
			<label>Password:</label><br>
			<input name="password" type="password" id="password" required>
			<br><br>
			<input type="submit" name="Submit" value="LOGIN">
		</form>
		<hr />
		<footer>
		 &copy;2016 <a href="http://www.VelozityWeb.com">www.VelozityWeb.com</a>
		</footer>
	</body>
</html>