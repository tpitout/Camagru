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
  if (empty($_SESSION['uname']))
  {
    header("location: index.php");
  }
  ?>
  <div class="topnav">
    <a href="main.php" class="active">Home</a>
    <a href="take-pic.php">Post</a>
    <a href="account.php">Account</a>
		<a href="logout.php">Log Out</a>
  </div>
  <div class="spacer5"></div>
<?php
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <TREDX@tpitout.camagru.com>' . "\r\n";

$conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");
$id = $_GET['id'];
$query = $conn->prepare("SELECT * FROM images WHERE id = '$id'");
$query->execute();
$r = $query->fetchAll();

        foreach ($r as $tmp)
        {
            $img = $tmp["data"];
            echo "<h2>Uploaded by Email: " . $tmp['username'] . "</h2><br>";
            echo "<h2>Image ID: " . $tmp['id'] . "</h2><br>";
            $imgid = $tmp['id'];
            $email1 = $tmp['username'];
            echo '<img width="400" src="' . $img . '" /><br>';
            echo "<h2>Likes: </h2>" . "<h1>" . $tmp['likes'] . "</h2>";

        }
        ?>

    <form method="POST">
        <input type="text" placeholder="Type A Comment..." pattern="^[_A-z0-9]*((-|\s)*[_A-z0-9])*$" name="comment">
        <input type="checkbox" checked="false" name="like" value="value1"><h2>Like</h2>
        <button type="submit">Post</button>
    </form>
    <?php

        if (isset($_POST['like']))
        {
            $conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");
            $query = $conn->prepare("UPDATE images SET likes = (likes + 1) WHERE id = $imgid");
            $query->execute();
        } else
        {
            $notif = 0;
        }
    ?>
    <?php
    if (isset($_POST['comment']) && !empty(trim($_POST['comment'])))
    {
        $comment = trim($_POST['comment']);
        $comment =  $_SESSION['uname'] . ": " . $comment;
        $query = $conn->prepare("INSERT INTO comment(id, comment) VALUES (:id9, :comm9)");
        $query->execute([':id9'=>$imgid, ':comm9'=>$comment]);
        $comment = "";
        $query = $conn->prepare("SELECT * FROM user_data WHERE email = '$email1'");
        $query->execute();
        $r = $query->fetchAll();
        foreach ($r as $tmp)
        {
            $notif = $tmp["notif"];
        }
        if ($notif == "1") {
            $msg = '<!DOCTYPE html><html><head><title>T.PITOUT</title> <html lang="en"><meta charset="UTF-8"></head><body>
            <div style="display:inline-block;">
            <h1 style="color: #2f2f2f;" >' . $_SESSION['uname'] . ' </h1> <h2 style="color:#2f2f2f;font-weight:lighter;">Left A Comment!</h2><br>
            <a style="font-size: 30px;background:#2f2f2f;color:white;text-decoration: none;padding: 5px 5px;" href="http://127.0.0.1:8080/index.php">Go Check Out!</a>
            </div></body></html>';
            mail($email1,"Comment", $msg, $headers);
        }

    }

    $query = $conn->prepare("SELECT * FROM comment WHERE id = '$imgid'");
    $query->execute();
    $r = $query->fetchAll();

        foreach ($r as $tmp)
        {
            if (isset($tmp["data"])) {
                $img = $tmp["data"];
            }
            echo "<h2>" . $tmp['comment'] . "</h2><br>";

        }
echo "<div class='spacer5'></div>";
?>

<div class="container_bot">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>

</body>
</html>