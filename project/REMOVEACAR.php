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
   

  $firstname = $_POST['First_Name'];
$lastname = $_POST['Last_Name'];
$carnum = $_POST['car_num'];
//....................trigger..............

$pql="SELECT car_no FROM customer_details WHERE car_no='$carnum'";
  $result31=mysqli_query($conn,$pql);
     //converting car type sql result to string
  $result32 = mysqli_fetch_assoc($result31);
    $resultstring33 = $result32['car_no'];
  



 if ($resultstring33==$carnum) 
    {


//...................getting valet id..............................

$ssql ="SELECT id FROM valet_details WHERE availability= '0' ";
$result8=mysqli_query($conn,$ssql);
//initialize an array to hold all the parking slot id values
$datas=array();
if(mysqli_num_rows($result8)>0)
while($row=mysqli_fetch_assoc($result8)){
	//stores all id's into the array...
	$datas[]=$row;
}
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
if ($mi==NULL){
  echo "sorry no free valet is available please wait...";
}
else{
$_SESSION['ID']=$mi;
$dql="SELECT first_name FROM valet_details WHERE id='$mi';";
$result21=mysqli_query($conn,$dql);
 $result22 = mysqli_fetch_assoc($result21);
 //first name of free valet to remove car.............
    $resultstring2 = $result22['first_name'];
    echo"car will be retreived by :";
    print_r($resultstring2 );
    echo "<br>";

   //....................updating who will remove the car................
$eql="UPDATE service_details SET retreived_by='$resultstring2' WHERE car_no='$carnum';";
if ($conn->query($eql) === TRUE) {
  
      echo "<br>";

} else {
    echo "Error: " . $eql . "<br>" . $conn->error;
}
//
//....................getting fee of user based on cartype......................
//....................trigger..............

$vql="SELECT car_type FROM customer_details WHERE car_no='$carnum'";
  $result310=mysqli_query($conn,$vql);
     //converting car type sql result to string
  $result320 = mysqli_fetch_assoc($result310);
    $resultstring330 = $result320['car_type'];
    echo $resultstring330;
    echo "test";


$getfee="SELECT type_fare FROM parking_fee  WHERE car_type='$resultstring330'";
$result3=mysqli_query($conn,$getfee);
//..................converting type fare from sql type to int.........................
  $row1 = mysqli_fetch_assoc($result3);
//..........value of fare is here................
  $row2=$row1['type_fare'];
    echo"the fare is";
    print($row2);
    echo "<br>";
    
    
//.................showing where car is parked......................................
    $gql="SELECT floor_no, slot_no FROM parking_slot WHERE car_no='$carnum'";

     $result4=mysqli_query($conn,$gql);
  $result5 = mysqli_fetch_assoc($result4);
  echo"car available on floor:";
  echo" ";
  $result69=$result5['floor_no'];
  print($result69);
  echo" in the  slot number:";
  $result79=$result5['slot_no'];
  echo" ";
  print($result79);
  echo "<br>";


//.......................making parkingking slot vacant..................................................
    $fql="UPDATE parking_slot SET parking_status='0',car_no='NULL' WHERE car_no='$carnum'";
    if ($conn->query($fql) === TRUE) {
     echo"parking slot vacated";
     echo" ";
      echo "<br>";

} else {
    echo "Error: " . $fql . "<br>" . $conn->error;
}
 //.................deleting customer details...........
 $tql="DELETE FROM customer_details  WHERE car_no='$carnum'";
 if ($conn->query($tql) === TRUE) {
  include('displayremove.php');

} else {
    echo "Error: " . $tql . "<br>" . $conn->error;
}
}
}
else {
    echo "car wasnt parked in parking ";
    echo "<br>";
    echo"#triggered".$pql."<br>" .$conn->error;
}


$conn->close();
?>