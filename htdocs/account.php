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


  <?php
  	if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  if (empty($_SESSION['uname']))
  {
    header("location: index.php");
  }
    $conn = new PDO('mysql:host=localhost;dbname=maindata', "root", "123");

  $em = $_SESSION['email'];
  if (!empty($_POST['uname']) || !empty($_POST['email']) || !empty($_POST['psw']) || !empty($_POST['psw2']))
  {
    $USERNAME = trim($_POST['uname']);
	  $EMAIL = trim($_POST['email']);
	  $PASSWORD = hash("md5", (trim($_POST['psw']))."TREDX");
    $PASSWORD2 = hash("md5" , (trim($_POST['psw2']))."TREDX");
    if (isset($_POST['notif']))
    {
      $notif = 1;
    } else
    {
      $notif = 0;
    }
  }
  $msg = "INFO HAS BEEN UPDATED!";

  if (!empty($USERNAME) && !empty($EMAIL) && !empty($PASSWORD) && !empty($PASSWORD2))
	{
		if ($PASSWORD == $PASSWORD2 )
		{
      if ($EMAIL != $em)
      {
        $sql = $conn->prepare("SELECT * FROM user_data WHERE email = :em9");
        $sql->execute(['em9'=>$EMAIL]);
        $result = $sql->fetchAll();
        if (count($result) >= 1)
        {
          echo "<div class='error'><h5>Email/Username Already Taken</h5></div>";
        }
        else {
  
          $sql = $conn->prepare("UPDATE user_data SET password = :psw9, email = :em9, username = :uname9, notif = :notif WHERE email = '$em'");
          $sql->execute(['em9'=>$EMAIL, 'psw9'=>$PASSWORD, 'uname9'=>$USERNAME, ':notif'=>$notif]);
          mail($EMAIL,"INFO UPDATED",$msg);
          header("location: index.php");
        }
      }
      else
      {
        $sql = $conn->prepare("UPDATE user_data SET password = :psw9, email = :em9, username = :uname9, notif = :notif WHERE email = '$em'");
        $sql->execute(['em9'=>$EMAIL, 'psw9'=>$PASSWORD, 'uname9'=>$USERNAME, ':notif'=>$notif]);
        mail($EMAIL,"INFO UPDATED",$msg);
        header("location: index.php");
      }
		}
		else
		{
			echo "<div class='error'><h5>Passwords Do Not Match</h5></div>";
		}
	}
  ?>

  <div class="spacer5"></div>
<h1>USERNAME</h1>
<?php
$name = $_SESSION['uname'];
$code = "<h2>$name</h2>";
echo $code;
?>

<h1>EMAIL</h1>
<?php
$name = $_SESSION['email'];
$code = "<h2>$name</h2>";
echo $code;
?>

<br>


<div class="block">
		<form method="POST">
			<h1>UPDATE DETAILS</h1>
			<h2>USERNAME</h2><br>
			<input type="text" placeholder="Enter Username" name="uname" required>

			<h2>EMAIL</h2><br>
			<input type="email" placeholder="Enter Email" name="email" required>

			<h2>PASSWORD</h2><br>
			<h4>Between 4-8 characters, 1 Uppercase & 1 Number</h4>
			<input type="password" placeholder="Enter Password" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$" name="psw" required><br>

	    <h2>RE-TYPE PASSWORD</h2><br>
			<input type="password" placeholder="Enter Password Again" pattern="^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,8}$" name="psw2" required><br>

      <input type="checkbox" checked="checked" name="notif" value="value1">
    Recieve Emails
  <span class="checkmark"></span>
			<button type="submit">UPDATE</button>
	</form>
	</div>
<div class="spacer5"></div>
<div class="container_bot" style="background-color:#2f2f2f">
<p1>&#169 created by Tredeaux Pitout</p1>
</div>
</body>
</html>
