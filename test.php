
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$sql = "INSERT INTO location (location,charges) 
                                VALUES ('thika town','470')";
if ($conn->query($sql) === TRUE) {
echo $error = "Sucessfully Deleted" ;
} else {
 echo   $erro = "Error " . $sql . "<br>" . $conn->error;
}
<select>
<?php
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql_up = "SELECT * FROM location ORDER BY id";
$result_up = $conn->query($sql_up);
if ($result_up->num_rows > 0) { while($row_up = $result_up->fetch_assoc()) {
echo "<option value='". ucfirst($row_up["location"]) . "'>". ucfirst($row_up["location"]). "</option>" ;}}
?>
</select>


