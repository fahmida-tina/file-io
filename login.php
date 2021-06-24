<?php 
	$uname = $pass = "";
	if($_SERVER['REQUEST_METHOD'] === "POST") {
		$username = "tina";
		$password = "123";

		if($username === $_POST['username'] && $password === $_POST['password']) {

			if(isset($_POST['rememberme'])) {
				setcookie("username", $username, time() + 60*60*24);
				setcookie("password", $password, time() + 60*60*24);
				setcookie("rememberme", "1", time() + 60*60*24);
			}

			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['password'] = $password;

			header("Location: welcome.php");
		}
	}

	if(isset($_COOKIE['rememberme'])) {
		$uname = $_COOKIE['username'];
		$pass = $_COOKIE['password'];
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
</head>
<body>
	<h1>Login Form</h1>
	<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
		<label for="username">Username: </label>
		<input type="text" name="username" id="username" value="<?php echo $uname; ?>">

		<br><br>

		<label for="password">Password: </label>
		<input type="password" name="password" id="password" value="<?php echo $pass; ?>">

		<br><br>

		<input type="checkbox" name="rememberme" id="rememberme" value="1">
		<label for="rememberme">Remember Me</label>

		<input type="submit" name="submit" value="Login">
	</form>

	<br>

	<a href=" welcome.php">Register</a>

</body>
</html>