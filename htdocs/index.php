<!DOCTYPE html>
<html>
<head>
<title>T.PITOUT</title>
<html lang="en">
<meta charset="UTF-8">
<meta name="description" content="WeThinkCode_ Project Camagru">
<meta name="author" content="Tredeaux Pitout">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel = "stylesheet" type = "text/css" href = "CSS/basics.css" />
<link rel = "stylesheet" type = "text/css" href = "CSS/modal.css" />
<link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>

</head>
<body>
<div class="spacer1"></div>

	<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");
	if (!empty($_POST['uname']) || !empty($_POST['email']) || !empty($_POST['psw']))
	{
	$USERNAME = trim($_POST['uname']);
	$EMAIL = trim($_POST['email']);
	$PASSWORD = hash("md5", (trim($_POST['psw']))."TREDX");
	}
	$sql = $conn->prepare("SELECT * FROM user_data WHERE username = :usr9
	AND password = :psw9 AND email = :em9 AND verified = '1'");
	if (isset($USERNAME) && isset($EMAIL) && isset($PASSWORD))
	{
		$sql->execute(['usr9'=>$USERNAME, 'psw9'=>$PASSWORD, 'em9'=>$EMAIL]);
	}
	$result = $sql->fetchAll();
	if (sizeof($result) == 1)
	{
		$_SESSION['uname'] = $USERNAME;
		$_SESSION['psw'] = $PASSWORD;
		$_SESSION['email'] = $EMAIL;
		$_SESSION['log'] = "1";
		header('Location: main.php');
	}
	else {
		if (!empty($USERNAME))
		{
		echo "<div class='error'><h5>User Not Successfully Registered</h5></div>";
		}
	}
?>

	<div class="block">
	<form method="POST" >
		<h1>WELCOME</h1>
		<h2>USERNAME</h2>
		<input type="username" placeholder="Enter Username" name="uname" required>

		<h2>EMAIL</h2>
		<input type="email" placeholder="Enter Email" name="email" required>

		<h2>PASSWORD</h2>
		<input type="password" placeholder="Enter Password" name="psw" required><br>

		<button type="submit" >LOGIN</button>

	</form>

	<a class="sbut" href="forgot.php">FORGOT PASSWORD</a>

	<a  href="register.php"><h3>REGISTER</h3></a>
	</div>




	<div class="container_bot" style="background-color:#2f2f2f">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>
</body>
</html>
