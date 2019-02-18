<div id="wrapper">
	<div id="page">
<p>
<p>
		<div id="box2">
			<p>As previously observed within most organizations that deal with high income businesses most of its income generated from secondary material which is of less value,
			waste or primary produce of another organization it has also been observed that people hardly take a perfect account of the resources they own being that most are rather ignorant or less advised</p>
		
		</div>
<div id="box1">
<center>
<b>Application Form </b> <p>

<i><font color="red"><?php echo @$mess ; ?></font></i>
<i><font color="green"><?php echo @$mes ; ?></font></i>
<p>
<form action="index.php?page=1" method="post">
<table>
<tr>
<td>National Id </td><td><input type="text" name="nat_id" maxlength="8"><td/>
</tr><tr>
<td>First Name</td><td><input type="text" name="f_name" maxlength="20"></td>
</tr><tr>
<td>Last Name</td><td><input type="text" name="l_name" maxlength="20"></td>
</tr><tr>
<td>Phone Number</td><td><input type="text" name="mobile_no" maxlength="10" placeholder="07xxxxxxxx"><td/>
</tr><tr>
<td>Password</td><td><input type="password" name="password" maxlength="10"><td/>
</tr><tr>
<td>Confirm Password</td><td><input type="password" name="confirm" maxlength="10"><td/>
</tr><tr>
<td>Residential Area</td><td>
<select name="location">
<?php
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM location ORDER BY id";
$result = $conn->query($sql);
if ($result->num_rows > 0) { while($row = $result->fetch_assoc()) {echo "<option value='". ucfirst($row["location"]) . "'>". ucfirst($row["location"]). "</option>" ;}} else {}
?> 
</select>
</td>
</tr><tr>
<td>Type of Garbage</td>
<td>
<select name="gabbage_type">
<?php
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}

$sql = "SELECT * FROM gabbage_type ORDER BY id";
$result = $conn->query($sql);

if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{echo "<option value='". ucfirst($row["name"]) . "'>". ucfirst($row["name"]). "</option>" ;}

} else {

}

?> 

</select>
</td>
</tr><tr>
<input type="hidden" name="were" value="5s7s8f5t4">
<td> </td><td><input type="submit" value="Apply"></td>
</tr>
</table>
</form>
</center>
</div>
</div>
</div>