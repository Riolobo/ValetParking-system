<?php

$servername = "localhost";
$user = "root";
$pass = "root";
$dbname = "valetparking";

// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$firstname = $_POST[''];
$lastname = $_POST[''];
$carnum = $_POST[''];
$cartype = $_POST[''];

$phone= $_POST[''];


$sql = "INSERT INTO customer_details (car_no, first_name, last_name,phone_no)
VALUES ('$carnum', '$firstname', '$lastname',$phone,'$cartype')";

if ($conn->query($sql) === TRUE) {
    echo "data entered";
} else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>