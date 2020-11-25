<?php
include('SESSION.php');
if(!isset($_SESSION['login_user'])){
header("location: text.php"); // Redirecting To Home Page
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="" rel="stylesheet" type="">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>
</body>
</html>