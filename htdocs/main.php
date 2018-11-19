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

  <div class="topnav">
    <a href="main.php" class="active">Home</a>
    <a href="take-pic.php">Post</a>
    <a href="account.php">Account</a>
		<a href="logout.php">Log Out</a>
  </div>
<br>
<div class="block2">
  <?php
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  $UNAME = $_SESSION['uname'];
  echo "<h6>";
  echo $UNAME;
  echo "</h6>";
  ?>
  </div>
<?php
if (isset($_SESSION['log']))
{
  if ($_SESSION['log'] == "1")
  
    {
      echo "YOU ARE LOGGED IN AND CAN LIKE & COMMENT";
      $comment = true;
      $like = true;
    }
  
}
  ?>
  <br>
  <?php

$conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");
$EM = $_SESSION["email"];
$query = $conn->prepare("SELECT * FROM images ORDER BY crdate DESC ");
$query->execute();
$res = $query->fetchAll();
$total_res = count($res);
echo "<h2>Images Loaded: ".$total_res."</h2>";
$respage = 5;
$numpages = ceil($total_res/$respage);

if (!isset($_GET['page']))
{
  $page = 1;
} else {
  $page = $_GET['page'];
}
$starting_num = ($page - 1) * $respage;

$query = $conn->prepare("SELECT * FROM images ORDER BY crdate DESC LIMIT " . $starting_num . "," . $respage);
$query->execute();
$r = $query->fetchAll();

        foreach ($r as $tmp)
        {
            $img = $tmp["data"];
            echo "<div style='display: inline-block; margin: 2px 2px; border: 5px solid #2f2f2f;'>";
            echo "<a href='http://127.0.0.1:8080/interact.php?id=". $tmp['id']."'>";
            echo '<img width="300" src="' . $img . '" /><br>';
            echo $tmp['username'] . " " . $tmp['id'];
            echo "</div>";
        }
echo '<br><div style="display:inline-block;">';
for ($page=1;$page<=$numpages;$page++) {
    echo '<h3 style="font-size: 22px; display: inline-block;"><a href="main.php?page=' . $page . '">' . $page . '</a></h4></div>';
}

?>
<div class="container_bot">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>

  </body>
  </html>