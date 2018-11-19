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
	if (!empty($_POST['uname']) || !empty($_POST['email']) || !empty($_POST['psw']) || !empty($_POST['psw2']) || !empty($_POST['cap']))
	{
	$USERNAME = trim($_POST['uname']);
	$EMAIL = trim($_POST['email']);
	$PASSWORD = hash("md5", (trim($_POST['psw']))."TREDX");
	$PASSWORD2 = hash("md5" , (trim($_POST['psw2']))."TREDX");
	$CAP = trim($_POST['cap']);
	}
	$headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: <TREDX@tpitout.camagru.com>' . "\r\n";
	$msg1 = '<!DOCTYPE html>
	<html>
	<head>
	<title>T.PITOUT</title>
	<html lang="en">
	<meta charset="UTF-8">
	</head>
	<style>
	</style>
	<body>
	<h1 style="color: #2f2f2f; text-align: center;" >WELCOME!</h1><br>
	<h2 style="color: #2f2f2f;  font-weight: lighter; text-align: center;"
	>CLICK ON THE BUTTON TO REGISTER</h2>
	<br>
	 <a style="background-color: #2f2f2f; text-decoration: none; color: white; border: 5px solid #2f2f2f; 
	 width: 100%; align: center; text-align:center;display:block;"
	  href="http://127.0.0.1:8080/validate.php?token=';

$msg3 = '">CONFIRM!</a></body></html>';


	if (!empty($USERNAME) && !empty($EMAIL) && !empty($PASSWORD) && !empty($PASSWORD2) && !empty($CAP))
	{
		if ($PASSWORD == $PASSWORD2)
		{
			if (strtolower($CAP) === "w6 8hp")
			{
						$sql = $conn->prepare("SELECT * FROM user_data WHERE email = :em9");
						$sql->execute(['em9'=>$EMAIL]);
						$result = $sql->fetchAll();
						if (count($result) >= 1)
						{
							echo "<div class='error'><h5>Email/Username Already Taken</h5></div>";
						}
						else
						{
							$token = hash("md5", $USERNAME.$EMAIL."TREDX".$PASSWORD);
							$sql = $conn->prepare("INSERT INTO user_data(username, email, password, token) VALUES (:uname9, :em9, :psw9, :tkn)");
							$sql->execute(['em9'=>$EMAIL, 'psw9'=>$PASSWORD, 'uname9'=>$USERNAME, 'tkn'=>$token]);
							$msg = $msg1.$token.$msg3;
							$msg = wordwrap($msg,70);
							mail($EMAIL,"TREDX REGISTRATION", $msg, $headers);
							echo "<script>
							alert('Go Check Your Email!');
							</script>";
							$_SESSION['uname'] = $USERNAME;
							$_SESSION['email'] = $EMAIL;
						}
			}
			else
			{
				echo "<div class='error'><h5>CAPTCHA Invalid</h5></div>";
			}
		}
		else
		{
			echo "<div class='error'><h5>Passwords Do Not Match</h5></div>";
		}
	}
	?>

		<div class="block">
		<form method="POST">
			<h1>WELCOME</h1>
			<h2>USERNAME</h2><br>
			<input type="username" placeholder="Enter Username" name="uname" pattern="^[_A-z0-9]*((-|\s)*[_A-z0-9])*$" required>

			<h2>EMAIL</h2><br>
			<input type="email" placeholder="Enter Email" name="email"  required>

			<h2>PASSWORD</h2><br>
			<h4>Between 4-8 characters, 1 Uppercase & 1 Number</h4>
			<input type="password" placeholder="Enter Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$" name="psw" required><br>

	    <h2>RE-TYPE PASSWORD</h2><br>
			<input type="password" placeholder="Enter Password Again" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$" name="psw2" required><br>

			<img src="img/captcha.gif" width="40%">
			<h2>ENTER CAPTCHA</h2><br>
			<input type="text" placeholder="Enter Captcha" name="cap" required><br>

			<button type="submit">REGISTER</button>


    <div><a href="index.php"><h3>LOGIN</h3></a></div>
	</form>
	</div>
	<div class="container_bot" style="background-color:#2f2f2f">
<p1>&#169 created by Tredeaux Pitout &nbsp</p1>
</div>
</body>
</html>
