<?php

// Define $username and $password
$username = $_POST['User_Name'];
$password = $_POST['password'];
// mysqli_connect() function opens a new connection to the MySQL server.
$conn = mysqli_connect("localhost", "root", "", "valetparking");
// SQL query to fetch information of registerd users and finds user match.
$query = "SELECT username, password from valet_details where username='$username';";

     $result=mysqli_query($conn,$query);
  $row = mysqli_fetch_assoc($result);
// To protect MySQL injection for Security purpose

if($row['username']==$username&& $row['password']==$password){//fetching the contents of the row {
 // Initializing Session
include('action.html'); // Redirecting To Profile Page
}
else{echo"invalid username or password plz try again";
 // Closing Connection
}
$conn->close();
?>
