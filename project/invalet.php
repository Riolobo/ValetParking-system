<?php
$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "valetparking";

// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$fname = $_POST['First_Name'];
$lname = $_POST['Last_Name'];
$uname = $_POST['User_Name'];
$password= $_POST['password'];
$email= $_POST['Email_Id'];
$phone= $_POST['Mobile_Number'];
$address= $_POST['Address'];

$gender = $_POST['Gender'];




$sql = "INSERT INTO valet_details ( first_name, last_name,username,PASSWORD,EMAIL_ID,PHONE_NO,ADDRESS,GENDER,availability)
VALUES ('$fname','$lname','$uname','$password','$email',$phone,'$address','$gender',0)";

if ($conn->query($sql) === TRUE) {
	
	  $aql ="SELECT id FROM valet_details WHERE username= '$uname'";
$result1=mysqli_query($conn,$aql);
   $result2 = mysqli_fetch_assoc($result1);
    $resultstring = $result2['id'];

    include('registered_page.php');
   


} else {
    echo "error" . $sql . "<br>" . $conn->error;
}

$conn->close();
?>