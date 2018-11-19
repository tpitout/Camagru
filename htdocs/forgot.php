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
$EMAIL = trim($_POST['email']);
$_SESSION['email'] = $EMAIL;
$msg = "http://127.0.0.1:8080/newpsw.php";
if (!empty($EMAIL))
{
  mail($EMAIL,"RESET PASSWORD",$msg);
  echo "<script>
  alert('Go Check Your Email!');
  </script>";
}
?>
<div class="block">
<form method="POST" >
  <h1>ENTER EMAIL</h1>

  <h2>EMAIL</h2>
  <input type="email" placeholder="Enter Email" name="email" required>

  <button type="submit" >RESET</button>
</form>

</div>
	<div class="container_bot" style="background-color:#2f2f2f">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>
</body>
</html>
