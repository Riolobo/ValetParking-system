<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "valetparking";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$id=$_SESSION['ID'];
$lql="UPDATE valet_details SET availability='0'  WHERE id = $id";
if ($conn->query($lql) === TRUE) {
     include('action.html') ;

} else {
    echo "Error: " . $lql . "<br>" . $conn->error;
}
session_destroy();

//
$conn->close();
?>
