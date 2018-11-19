<?php
    if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

    $filename    = $_FILES["picture"]["tmp_name"];

    $data = file_get_contents($filename);
    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

    $USERNAME = $_SESSION['email'];
    $conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");
    $sql = $conn->prepare("INSERT INTO images (username, data) VALUES ('$USERNAME', '$base64')");
	$sql->execute();

    header('Location: take-pic.php');
?>