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

	<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");

	$EMAIL = $_SESSION['email'];
	$PASSWORD = hash("md5", (trim($_POST['psw']))."TREDX");
	$PASSWORD2 = hash("md5" , (trim($_POST['psw2']))."TREDX");
	$msg = "Your Password has been UPDATED!";

	if (!empty($PASSWORD) && !empty($PASSWORD2) && isset($PASSWORD) && isset($PASSWORD2))
	{
		if ($PASSWORD == $PASSWORD2 )
		{
				$token = hash("md5", $USERNAME.$EMAIL."TREDX".$PASSWORD);
				$sql = $conn->prepare("UPDATE user_data SET password = :ps8 WHERE email = :em9");
				$sql->execute(['em9'=>$EMAIL, 'ps8'=>$PASSWORD]);
				mail($EMAIL,"PASSWORD CHANGED",$msg);
				$_SESSION['psw'] = $PASSWORD;
				$_SESSION['email'] = $EMAIL;
				$_SESSION['token'] = $token;
				$_SESSION['uname'] = $USERNAME;

		}
		else
		{
			echo "<div class='error'><h5>Passwords Do Not Match</h5></div>";
		}
	}
	?>

	<div class="block">
	<form method="POST">
		<h1>RESET PASSWORD</h1>

		<h2>PASSWORD</h2><br>
			<h4>Between 4-8 characters, 1 Uppercase & 1 Number</h4>
			<input type="password" placeholder="Enter Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$" name="psw" required><br>

	    <h2>RE-TYPE PASSWORD</h2><br>
			<input type="password" placeholder="Enter Password Again" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$" name="psw2" required><br>

		<button type="submit">RESET</button>
		<a class="sbut" href="index.php">LOGIN</a>

	</form>
	</div>
	<div class="container_bot" style="background-color:#2f2f2f">
<p1>&#169 created by Tredeaux Pitout &nbsp</p1>


</div>
</body>
</html>
