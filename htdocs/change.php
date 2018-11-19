<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!empty(trim($_GET['uname'])) && !empty(trim($_GET['email'])) && !empty(trim($_GET['psw'])))
{
	$USERNAME = trim($_GET['uname']);
	$EMAIL = trim($_GET['email']);
	$PASSWORD = trim($_GET['psw']);

	$oldemail = $_SESSION['email'];
	$oldusername = $_SESSION['uname'];
	$oldpsw = $_SESSION['psw'];

	$sql = "UPDATE user_data SET db_Username = '$USERNAME', db_email = '$EMAIL', db_password = '$PASSWORD' where user_data.db_Username = '$oldusername'";
	mysqli_query($data, $sql);
	header('Location:index.php');
}

?>
