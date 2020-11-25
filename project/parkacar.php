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

$id = $_POST['VID'];
$firstname = $_POST['First_Name'];
$lastname = $_POST['Last_Name'];
$carnum = $_POST['car_num'];
$cartype = $_POST['Car_Type'];

$phone= $_POST['Mobile_Number'];

//
$_SESSION['ID']=$id;
    
//


//
//
$dql="UPDATE valet_details SET availability='1'  WHERE id = $id";
mysqli_query($conn,$dql);

//to get all the parking slots that are available
$sql ="SELECT id FROM parking_slot WHERE parking_status= 0 ";
$result=mysqli_query($conn,$sql);
//initialize an array to hold all the parking slot id values
$datas=array();
if(mysqli_num_rows($result)>0)
while($row=mysqli_fetch_assoc($result)){
  //stores all id's into the array...
  $datas[]=$row;
}
//print_r($datas);
    $mi=0;
    //finiding number of elements in array...
   $n = count($datas);  
   $min = $datas[0]; 
   //finding minimum id value ,such that we get first available parking spot
   for ($i = 1; $i < $n; $i++)  {
       if ($min > $datas[$i]) {
           $min = intval($datas[$i]);
            
       }
   }
   //php array format array ([id]=>'value');the below code extracts the 'value'(int) for querying purposes
   $mi=$min['id'];
   //test
  // print_r($min);
  // print_r($mi);
  // print_r($mi);
  
 //query to enter the car into parking slot and update parking status
$tql="UPDATE parking_slot SET parking_status='1' ,car_no ='$carnum' WHERE id = '$mi' ";

//checkih if query runs
if ($conn->query($tql) === TRUE) {
     echo " parking slot status updated";
      echo "<br>";

} else {
    echo "Error: " . $tql . "<br>" . $conn->error;
} 


// Printing parking spot availability

$gql="SELECT floor_no, slot_no FROM parking_slot WHERE car_no='$carnum'";

     $result4=mysqli_query($conn,$gql);
  $result5 = mysqli_fetch_assoc($result4);
  echo"parking available on floor :   ";
  $result6=$result5['floor_no'];
  print_r($result6);
   echo "<br>";
  echo"parking available slot number :    ";
  $result7=$result5['slot_no'];
  
  print_r($result7);
   echo "<br>";

//
   $aql ="SELECT first_name FROM valet_details WHERE id= $id ";
$result1=mysqli_query($conn,$aql);
  $result2 = mysqli_fetch_assoc($result1);
    $resultstring = $result2['first_name'];
    echo $resultstring;

   //
$bql ="INSERT INTO service_details (car_no, parked_by, retreived_by) VALUES ('$carnum', '$resultstring', 'NULL');";

if ($conn->query($bql) === TRUE) {
     echo "service details updated" ;

} else {
    echo "Error: " . $fee . "<br>" . $conn->error;
}

//


//
$qql = "INSERT INTO customer_details (first_name, last_name,car_no, phone_no,car_type)
VALUES ( '$firstname', '$lastname','$carnum',$phone,'$cartype')";
if ($conn->query($qql) === TRUE) {
 include('displaypark.php');
} else {
    echo "Error: " . $qql . "<br>" . $conn->error;
}
$conn->close();
?>

