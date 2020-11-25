<!DOCTYPE html>
<html>
<head>
	<title>To do list</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>

<body>
	<table>
<tr>

<th>TASK</th>
<th>DESCRIPTIOJN</th>
</tr>

<?php

$servername = "localhost";
$user = "root";
$pass = "";
$dbname = "todolist";

// Create connection
$conn = new mysqli($servername, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

	
$title = $_POST['TITLE'];
$description = $_POST['DESCRIPTION'];

$sql = "INSERT INTO todo (title,description)
VALUES ('$title', '$description')";

if ($conn->query($sql) === TRUE) {
    echo "";
} else {
    echo "error: " . $sql . "<br>" . $conn->error;
}
$sql2 = "SELECT  title, description FROM todo";
$result = $conn->query($sql2);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $row["title"]. "</td><td>" . $row["description"] . "</td><td>";

}
echo "</table>";
} else { echo "0 results"; }

$conn->close();

?>
<a href="doing.html" class="btn btn1"> Go Back</a>
</table>
</body>
</html>