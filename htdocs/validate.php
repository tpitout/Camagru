
	<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	$conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");

	$token = trim($_GET['token']);


	$sql = $conn->prepare("SELECT * FROM user_data where token = '$token'");
	$sql->execute();
	$result = $sql->fetchAll();
	if (sizeof($result) == 1)
	{
		$sql = $conn->prepare("UPDATE user_data SET verified = '1' WHERE token = '$token'");
		$sql->execute();
		header('Location: index.php');
	}
		?>
