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
<br>
<div class="block2">
  <?php
  $UNAME = $_SESSION['uname'];
  echo "<h6>";
  echo $UNAME;
  echo "</h6>";
  ?>
</div>
  <div>
    <a class="sbut" id="stick1">CAT</a>
    <a class="sbut" id="stick2">DUCK</a>
    <a class="sbut" id="stick3">TREDX</a>
    <a class="sbut" id="stick5">WTC</a>
    <a class="sbut" id="stick4">CLEAR</a>
  </div>

<div class="booth">
  <img class="overlay" id="photo" width="400" height="300">
  <video id="video" width="400" height="300" autoplay="true"></video>
  <button id="capture">TAKE PICTURE</button>
  <canvas id="canvas" width="400" height="300"></canvas>
</div>
<h2>Right Click and "Save Image As..." to Download</h2>
<script src="js/webcam.js"></script>

<div class="block">
<form action="process.php" method="post" enctype="multipart/form-data">
  <label for="picture">Picture:</label>
  <input type="file" name="picture"><br>
  <input type="submit" name="submit" value="Upload">
</form>
</div>
<?php
$conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");
$EM = $_SESSION["email"];
$query = $conn->prepare("SELECT * FROM images WHERE username = '$EM'");
$query->execute();

$res = $query->fetchAll();
         echo "<div style='border: 5px solid black;'>";

        foreach ($res as $tmp)
        {
            $img = $tmp["data"];
            
            echo "<div style='padding: 2px 2px; margin: 2px 2px; display: inline-block;'>";
            echo '<img id="myImg" src="' . $img . '" alt="" style="width:100%;max-width:300px" /></div>';
           
            
        }
        echo "</div>";
?>


<div class="spacer5"></div>
<div class="container_bot">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>

  </body>
  </html>
