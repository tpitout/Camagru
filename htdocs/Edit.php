
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
    <a href="take-pic.php">Take Pic</a>
    <a href="account.php">Account</a>
		<a href="logout.php">Log Out</a>
  </div>
<div class="spacer5"></div>
<div>
    <a class="sbut" id="stick1">CAT</a>
    <a class="sbut" id="stick2">DUCK</a>
    <a class="sbut" id="stick3">TREDX</a>
    <a class="sbut" id="stick5">WTC</a>
  </div>
  <h2>Refresh After Upload</h2>
<div class="booth">
<canvas id="myCanvas"></canvas>
</div>
<h2>Right Click and "Save Image As..."</h2>

</div>
<script src="js/upload.js"></script>
<div class="container_bot">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>

  </body>
  </html>
