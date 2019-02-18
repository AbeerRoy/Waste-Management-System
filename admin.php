<?php 
session_start() ;
?>
<?php
if(@$_GET['do'] == 6){ 
session_destroy();
header("location:index.php?page=2");
} else { }
?>

<?php 
if(empty($_SESSION['admin_u_name'])){
header("location:index.php?page=2");} else { }
?>

<?php
if(empty($_GET['gardel'])) { } else 
{
$del_gar = $_GET['gardel'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_query ($conn, "DELETE FROM gabbage_type WHERE id=$del_gar");
header("location:admin.php?do=3");
}
?>
<?php
if(empty($_GET['postdel'])) { } else 
{
$post_del = $_GET['postdel'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_query ($conn, "DELETE FROM notice WHERE id=$post_del");
}
?>

<?php
if(empty($_GET['locdel'])) { } else 
{
$del_loc = $_GET['locdel'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_query ($conn, "DELETE FROM location WHERE id=$del_loc");
header("location:admin.php?do=2");
}
?>
<?php
if(empty($_GET['admindel'])) { } else 
{
$admindel_id = $_GET['admindel'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_query ($conn, "DELETE FROM admin WHERE id=$admindel_id");
header("location:admin.php?do=5");
}
?>

<?php
if(empty($_GET['del'])) { } else 
{
$del_id = $_GET['del'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
mysqli_query ($conn, "DELETE FROM clients WHERE id=$del_id");
header("location:admin.php?do=1");
}
?>
<?php
if(empty($_POST['newpassword'])) { } else 
{
$newpassword = $_POST['newpassword'];
$connewpassword = $_POST['connewpassword'] ;
$username = $_SESSION['admin_u_name'] ;
if($connewpassword != $newpassword) { $passerror = "<font color='red'>Error! Password dont match</font>" ; } else {
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE admin SET password='$newpassword' WHERE username='$username'";
if ($conn->query($sql) === TRUE) { 
$passerror = "<font color='green'>Password Successfully Changed</font>" ;
} 
else { echo "error" ; }
}
}
?>
<?php
if(empty($_GET['app'])) { } else 
{
$id_app = $_GET['app'];
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE clients SET payment_status = '1' WHERE id=$id_app";
if ($conn->query($sql) === TRUE) { header("location:admin.php?do=1");} 
else { }
}
?>
<?php
if(empty($_GET['unsettle'])) { } else 
{
$id_unsettle = $_GET['unsettle'];
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

$sql = "UPDATE clients SET payment_status = '0' WHERE id=$id_unsettle";
if ($conn->query($sql) === TRUE) { header("location:admin.php?do=1");} 
else { }
}
?>
<?php 
if(empty($_POST['newadmin'])) { } else { 
$newadmin = $_POST['newadmin'] ;
$newadminpass = $_POST['newadminpass'];

$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$sql = "SELECT * FROM admin WHERE username='$newadmin' ";
$result = $conn->query($sql);
if ($result->num_rows > 0) { $error_mess = "<font color='red'>User already exists, Choose another username</font><p>" ;}  else {

$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO admin (username, password)
VALUES ('$newadmin','$newadminpass')";
if ($conn->query($sql) === TRUE) {
header("location:admin.php?do=5");
} else {

}

$conn->close();
}
}
?>
<?php 
if(empty($_POST['garbagetype'])) { } else { 
$garbagetype = $_POST['garbagetype'] ;
$charges = $_POST['charges'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO gabbage_type (name, charges)
VALUES ('$garbagetype','$charges')";
if ($conn->query($sql) === TRUE) {
header("location:admin.php?do=3");
} else {

}

$conn->close();
}
?>
<?php 
if(empty($_POST['area'])) { } else { 
$area = $_POST['area'] ;
$charges = $_POST['charges'];
$conn =mysqli_connect("localhost","root","","gabbage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO location (location, charges)
VALUES ('$area','$charges')";
if ($conn->query($sql) === TRUE) {
header("location:admin.php?do=2");
} else {

}

$conn->close();
}
?>
<?php 
if(empty($_POST['notice'])) { } else { 
$details = $_POST['notice'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
$date = date('l jS F Y ');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "INSERT INTO notice (date, details)
VALUES ('$date','$details')";
if ($conn->query($sql) === TRUE) {
$done = "<font color='green'>Successfully Published</font>" ;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
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
			<li class="current_page_item"><a href="admin.php">Welcome <?php echo  ucfirst($_SESSION['admin_u_name']) ?></a></li>
			<li><a href="admin.php?do=1">Manage Users & Payments</a></li>
			<li><a href="admin.php?do=2">Manage Locations & Payments</a></li>
			<li><a href="admin.php?do=3">Manage Garbage type & Payments</a></li>
			<li><a href="admin.php?do=4">Change Password</a></li>
			<li><a href="admin.php?do=5">Add another Admin</a></li>
			<li><a href="admin.php?do=6">Logout</a></li>
		</ul>
	</div>
</div>
<!-- end #header -->
<?php 
if(empty($_GET['do'])) { 
echo '
<div id="wrapper">
<div id="page">

<div id="box2"><p>From here admin can manage the whole system</p></div>

<div id="box1">
<center>
<b>Post notice or news to main website</b><p>
' . @$done . '
<p>
<form action="admin.php" method="POST">
<textarea name="notice" rows="6" cols="50"></textarea>
<p>
<input type="submit" value="Publish">
</form>
</div>
</div>
</div>';
}
elseif ($_GET['do'] == 1){ 
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM clients ORDER BY id";
$result = $conn->query($sql);
echo "
<div id='wrapper'>
<div id='page'>
<div id='box2'><p>Clients with Complete, pending payments and waiting approval<p> </div>
<div id='box1'>
<table border='1'>
<tr>
<th>National ID</th><th>Name</th><th>Amount</th><th>Location</th><th>Mobile No</th><th>Garbage Type</th><th>
Application Daate</th><th>Mpesa Code</th><th>Approve/Delete</th>
</tr> " ;
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{echo "
<tr>
<td>" . ucfirst($row["nat_id"]) . "</td>
<td>" . ucfirst($row["f_name"]) . "</td>
<td>" . ucfirst($row["amount"]) . "</td>
<td>" . ucfirst($row["location"]) . "</td>
<td>" . ucfirst($row["mobile_no"]) . "</td>
<td>" . ucfirst($row["gabbage_type"]) . "</td>
<td>" . ucfirst($row["application_date"]) . "</td>
<td>" . ucfirst($row["confirmation_code"]) . "</td>";
if($row["payment_status"] == 1) {
echo "<td>Payments settled | |
<a href='admin.php?unsettle=" . $row["id"] . "'>UnSettle</a>
</tr> " ;}
else {
echo "<td><a href='admin.php?app=" . $row["id"] . "'>Approve</a> or
<a href='admin.php?del=" . $row["id"] . "'>Del</a></td>
</tr> " ;
}
;}

}
echo "</table>
</div>
</div>
</div>" ;
}

elseif ($_GET['do'] == 2){ 
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM location ORDER BY id";
$result = $conn->query($sql);
echo "
<div id='wrapper'>
<div id='page'>
<div id='box2'><p>Different Locations and fee<p> </div>
<div id='box1'>
<table border='1'>
<tr>
<th>Location</th><th>Charges</th><th>Delete</th>
</tr> " ;
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{echo "
<tr>
<td>" . ucfirst($row["location"]) . "</td>
<td>" . ucfirst($row["charges"]) . "</td>
<td><a href='admin.php?locdel=" . $row["id"] . "'>Delete</a></td>
</tr>" ;
}
}
echo "
<form action='admin.php?do=2' method='POST'>
<tr><td><input type='text' name='area' placeholder='Area'></td>
<td colspan='2'><input type='text' name='charges' placeholder='Charges'></td>
</tr>
<tr><td colspan='3'><center><input type='submit' value='Add'><center></td></tr>
</form>
</table>
</div>
</div>
</div>" ;
}
elseif ($_GET['do'] == 3){ 
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM gabbage_type ORDER BY id";
$result = $conn->query($sql);
echo "
<div id='wrapper'>
<div id='page'>
<div id='box2'><p>Types of Garbage and fee charged to collect them<p> </div>
<div id='box1'>
<table border='1'>
<tr>
<th>Garbage Type</th><th>Charges</th><th>Delete</th>
</tr> " ;
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{echo "
<tr>
<td>" . ucfirst($row["name"]) . "</td>
<td>" . ucfirst($row["charges"]) . "</td>
<td><a href='admin.php?gardel=" . $row["id"] . "'>Delete</a></td>
</tr>" ;
}
}
echo "
<form action='admin.php?do=2' method='POST'>
<tr><td><input type='text' name='garbagetype' placeholder='Garbage type'></td>
<td colspan='2'><input type='text' name='charges' placeholder='Charges'></td>
</tr>
<tr><td colspan='3'><center><input type='submit' value='Add'><center></td></tr>
</form>
</table>
</div>
</div>
</div>" ;
}
elseif ($_GET['do'] == 4){ 
echo "
<div id='wrapper'>
<div id='page'>
<div id='box2'><p>Change Admin Password<p> </div>
<div id='box1'>
" . @$passerror . "
<table>
<form action='admin.php?do=4' method='POST'>
<tr><td><input type='password' name='newpassword' placeholder='New Password'></td>
<td colspan='2'><input type='password' name='connewpassword' placeholder='Confirm New Password'></td>
</tr>
<tr><td></td><td><input type='submit' value='Change Password'></td></tr>
</form>
</table>
</div>
</div>
</div>" ;
}
elseif ($_GET['do'] == 5){ 
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM admin ORDER BY id";
$result = $conn->query($sql);
echo "
<div id='wrapper'>
<div id='page'>
<div id='box2'><p>Different Administrators <p> </div>
<div id='box1'>
<table border='1'>
<tr>
<th>ID</th><th>Username</th><th>Delete</th>
</tr> " ;
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{echo "
<tr>
<td>" . ucfirst($row["id"]) . "</td>
<td>" . ucfirst($row["username"]) . "</td>
<td><a href='admin.php?admindel=" . $row["id"] . "'>Delete</a></td>
</tr>" ;
}
}
echo @$error_mess . "
<form action='admin.php?do=5' method='POST'>
<tr><td><input type='test' name='newadmin' placeholder='Admin Name'></td>
<td colspan='2'><input type='password' name='newadminpass' placeholder='Password'></td>
</tr>
<tr><td colspan='3'><center><input type='submit' value='Creat account'></center></td></tr>
</form>
</table>
</div>
</div>
</div>" ;
}
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM notice ORDER BY id";
$result = $conn->query($sql);
echo "
<div id='wrapper'>
	<div id='page'>
<p> <b>Delete Posts</b>
<p>
		<div id='box2'>" ;
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{
echo "<li>" . ucfirst($row["date"]) . " -- <a href='admin.php?postdel=" .$row["id"] . "'>Delete</a><br> - " . ucfirst($row["details"]) . "</li>";
}
}
echo "</div>
</div>
</div>" ;

?>





<div id="footer"><p>Garbage Collection Management System, All rights reserved.</p></div>
<!-- end #footer -->

