<?php 
session_start() ;
?>
<?php
if(@$_GET['do'] == 5){ 
session_destroy();
header("location:index.php?page=2");
} else { }
?>

<?php 
if(empty($_SESSION['clients_natid'])){
header("location:index.php?page=2");} else { }
?>



<?php
if(empty($_POST['newpassword'])) { } else 
{
$newpassword = $_POST['newpassword'];
$connewpassword = $_POST['connewpassword'] ;
$username = $_SESSION['clients_natid'] ;
if($connewpassword != $newpassword) { $passerror = "<font color='red'>Error! Password dont match</font>" ; } else {
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$newpasswor = md5($newpassword) ;
$sql = "UPDATE clients SET password='$newpasswor' WHERE nat_id='$username'";
if ($conn->query($sql) === TRUE) { 
$passerror = "<font color='green'>Password Successfully Changed</font>" ;
} 
else { echo "error" ; }
}
}
?>
<?php 
if(empty($_POST['mpesa_code'])){ } else 
{
$mpesa_code = $_POST['mpesa_code'];
$clientnational_id = $_SESSION['clients_natid'] ;
$payment_date = date("F j, Y");
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE clients SET confirmation_code = '$mpesa_code' , application_date = '$payment_date' WHERE  nat_id=$clientnational_id";
if ($conn->query($sql) === TRUE) { $sent = "Payments sent successfully" ; } 
else { }
}
?>

<?php 
if(empty($_POST['location_selection'])){ } else 
{
$change_loc = $_POST['location_selection'];
$clientnational_id = $_SESSION['clients_natid'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE clients SET location = '$change_loc' WHERE nat_id=$clientnational_id";
if ($conn->query($sql) === TRUE) { $sent = "Location Successfully Changed" ; } 
else { }
}
?>

<?php 
if(empty($_POST['garbage_selection'])){ } else 
{
$garbage_select = $_POST['garbage_selection'];
$client_garbage = $_SESSION['clients_natid'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE clients SET gabbage_type = '$garbage_select' WHERE nat_id=$client_garbage";
if ($conn->query($sql) === TRUE) { $sent = "Garbage Successfully Changed" ; } 
else { }
}
?>

<title>Garbage Collection Management System</title>
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<div id="header-wrapper">
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="index.php">Garbage Collection Management</a></h1>
		</div>
	</div>
	<div id="menuadmin">
		<ul>
			<li class="current_page_item"><a href="clients.php">Welcome <?php
$natid = $_SESSION['clients_natid'] ;			
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM clients WHERE nat_id = $natid";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{echo ucfirst($row["f_name"]) ;}
}			
?>
</a></li>
			<li><a href="clients.php?do=2">Manage Locations</a></li>
			<li><a href="clients.php?do=3">Manage Garbage Type</a></li>
			<li><a href="clients.php?do=4">Change Password</a></li>
			<li><a href="clients.php?do=5">Logout</a></li>
		</ul>
	</div>
</div>
<!-- end #header -->
<?php 
if(empty($_GET['do'])) {
echo '
<div id="wrapper">
<div id="page">

<div id="box2"><p>Make Online payments</p></div>

<div id="box1">
<center>
'; 
$logged_user = $_SESSION['clients_natid'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM clients WHERE nat_id = $logged_user";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) {
$_SESSION['location'] = $row["location"] ;
$_SESSION['gabbage_type'] = $row["gabbage_type"] ;
if($row["payment_status"] == 1) {
echo " 
<table>
<tr>
<td>Payments Status:</td><td><b>Settled</b></td>
</tr>
<td>Location:</td><td><b>" ;}
else {
echo "
<table>
<tr>
<td>Payments Status</td></td><td><b>Not Settled</b></td>
</tr>
<td>Location:</td><td><b>" ;
}
}
}

echo $logged_location = $_SESSION['location'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql1 = "SELECT * FROM location WHERE location = '$logged_location'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) 
{ while($row = $result1->fetch_assoc()) {
$_SESSION['locationcharges'] = $row["charges"];
echo "</b></td></tr><tr><td> Location Charges:</td><td><b> " . $row["charges"] . "</b></td></tr><tr><td> Garbage Type:</td><td><b>" ;

}
}

echo $gabbage_type = $_SESSION['gabbage_type'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql2 = "SELECT * FROM gabbage_type WHERE name = '$gabbage_type'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) 
{ while($row = $result2->fetch_assoc()) {
$_SESSION['gabbagetypecharges'] = $row["charges"] ;
echo  "</b></td></tr><tr><td> Garbage Type Charges:</td><td><b>" . $row["charges"] . "</b></td></tr>" ;
}
}

echo "<tr bgcolor='grey'><td><b>Total:</b></td><td><b>Ksh " ;
echo $total = $_SESSION['gabbagetypecharges'] + $_SESSION['locationcharges'] ;

$_SESSION['amount'] = $total ;

echo'
/-</b></td></tr></table>
<hr><font color="green"> ' . @$sent . '</font><p>
<form action="clients.php" method="POST">
Enter Mpesa Confirmation Code: <input type="text" name="mpesa_code">
<p><p>
<input type="submit" value="Pay">
</form>
</div>
</div>
</div>';
}

elseif ($_GET['do'] == 2){
echo '
<div id="wrapper">
<div id="page">

<div id="box2"><p>Change Your Current Location</p></div>

<div id="box1">
<center>
'; 
$logged_user = $_SESSION['clients_natid'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM clients WHERE nat_id = $logged_user";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) {
$_SESSION['location'] = $row["location"] ;
$_SESSION['gabbage_type'] = $row["gabbage_type"] ;
if($row["payment_status"] == 1) {
echo " 
<table>
<tr>
<td>Payments Status:</td><td><b>Settled</b></td>
</tr>
<td>Location:</td><td><b>" ;}
else {
echo "
<table>
<tr>
<td>Payments Status</td></td><td><b>Not Settled</b></td>
</tr>
<td>Location:</td><td>" ;
}
}
}
echo "<form action='clients.php?do=2' method='POST'><select name='location_selection'>" ;

$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql_up = "SELECT * FROM location ORDER BY id";
$result_up = $conn->query($sql_up);
if ($result_up->num_rows > 0) { while($row_up = $result_up->fetch_assoc()) {
echo "<option value='". ucfirst($row_up["location"]) . "'>". ucfirst($row_up["location"]). "</option>" ;}}

echo "</select>" ;

$logged_location = $_SESSION['location'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql1 = "SELECT * FROM location WHERE location = '$logged_location'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) 
{ while($row = $result1->fetch_assoc()) {
$_SESSION['locationcharges'] = $row["charges"];
echo "</td></tr><tr><td> Location Charges:</td><td><b> " . $row["charges"] . "</b></td></tr><tr><td> Garbage Type:</td><td><b>" ;

}
}

echo $gabbage_type = $_SESSION['gabbage_type'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql2 = "SELECT * FROM gabbage_type WHERE name = '$gabbage_type'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) 
{ while($row = $result2->fetch_assoc()) {
$_SESSION['gabbagetypecharges'] = $row["charges"] ;
echo  "</b></td></tr><tr><td> Garbage Type Charges:</td><td><b>" . $row["charges"] . "</b></td></tr>" ;
}
}

echo "<tr bgcolor='grey'><td><b>Total:</b></td><td><b>Ksh " ;
echo $total = $_SESSION['gabbagetypecharges'] + $_SESSION['locationcharges'] ;
echo'
/-</b></td></tr></table>
<br><font color="green"> ' . @$sent . '</font><p>
<input type="submit" value="Change Location">
</form>
</div>
</div>
</div>';

 
 } 
 elseif ($_GET['do'] == 3){
echo '
<div id="wrapper">
<div id="page">

<div id="box2"><p>Change Type of Garbage Collected</p></div>

<div id="box1">
<center>
'; 
$logged_user = $_SESSION['clients_natid'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM clients WHERE nat_id = $logged_user";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) {
$_SESSION['location'] = $row["location"] ;
$_SESSION['gabbage_type'] = $row["gabbage_type"] ;
if($row["payment_status"] == 1) {
echo " 
<table>
<tr>
<td>Payments Status:</td><td><b>Settled</b></td>
</tr>
<td>Location:</td><td><b>" ;}
else {
echo "
<table>
<tr>
<td>Payments Status</td></td><td><b>Not Settled</b></td>
</tr>
<td>Location:</td><td>" ;
}
}
}


echo $logged_location = $_SESSION['location'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql1 = "SELECT * FROM location WHERE location = '$logged_location'";
$result1 = $conn->query($sql1);
if ($result1->num_rows > 0) 
{ while($row = $result1->fetch_assoc()) {
$_SESSION['locationcharges'] = $row["charges"];
echo "</td></tr><tr><td> Location Charges:</td><td><b> " . $row["charges"] . "</b></td></tr><tr><td> Garbage Type:</td><td>" ;

}
}
echo "<form action='clients.php?do=3' method='POST'><select name='garbage_selection'>" ;

$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql_up = "SELECT * FROM gabbage_type ORDER BY id";
$result_up = $conn->query($sql_up);
if ($result_up->num_rows > 0) { while($row_up = $result_up->fetch_assoc()) {
echo "<option value='". ucfirst($row_up["name"]) . "'>". ucfirst($row_up["name"]). "</option>" ;}}

echo "</select>" ;

$gabbage_type = $_SESSION['gabbage_type'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql2 = "SELECT * FROM gabbage_type WHERE name = '$gabbage_type'";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) 
{ while($row = $result2->fetch_assoc()) {
$_SESSION['gabbagetypecharges'] = $row["charges"] ;
echo  "</td></tr><tr><td> Garbage Type Charges:</td><td><b>" . $row["charges"] . "</b></td></tr>" ;
}
}

echo "<tr bgcolor='grey'><td><b>Total:</b></td><td><b>Ksh " ;
echo $total = $_SESSION['gabbagetypecharges'] + $_SESSION['locationcharges'] ;
echo'
/-</b></td></tr></table>
<br><font color="green"> ' . @$sent . '</font><p>
<input type="submit" value="Change Garbage">
</form>
</div>
</div>
</div>';

 
 } 
 elseif ($_GET['do'] == 4){ 
echo "
<div id='wrapper'>
<div id='page'>
<div id='box2'><p>Change your Password<p> </div>
<div id='box1'>
<center>
" . @$passerror . "
<p>
<form action='clients.php?do=4' method='POST'>
<p><input type='password' name='newpassword' placeholder='New Password'><br>
<br><input type='password' name='connewpassword' placeholder='Confirm New Password'><br>
<br><input type='submit' value='Change Password'><p>
</form>
</center>
</table>
</div>
</div>
</div>" ;
}
else { }
?>





<div id="footer"><p>Garbage Collection Management System, All rights reserved.</p></div>
<!-- end #footer -->

<?php
if(empty($_SESSION['amount'])) { } else 
{
$money = $_SESSION['amount'];
$username = $_SESSION['clients_natid'] ;

$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE clients SET amount='$money' WHERE nat_id='$username'";
if ($conn->query($sql) === TRUE) { 
} 
else { echo "error" ; }
}

?>

