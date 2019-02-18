<?php
if(empty($_POST['were'])) { } 
elseif(empty($_POST['nat_id'])) { $mess = "National ID is missing" ;} 
elseif($_POST['nat_id'] < 9999999) { $mess = "Your National ID is not correct" ;} 
elseif(empty($_POST['f_name'])) { $mess = "First name is missing" ;} 
elseif(empty($_POST['l_name'])) { $mess = "Last name is missing" ; } 
elseif(empty($_POST['location'])) { $mess = "Location is missing" ; } 
elseif(empty($_POST['mobile_no'])) { $mess = "Mobile Number is missing" ;} 
elseif($_POST['mobile_no'] < 99999999) { $mess = "Your Mobile Number is not correct" ;} 
elseif(empty($_POST['password'])) { $mess = "Password is missing" ; } 
elseif(empty($_POST['confirm'])) { $mess = "Confirmation password is missing" ; } 
elseif($_POST['confirm'] != $_POST['password'] ) { $mess = "Password don't match";  } 
else {
$pass = md5($_POST['password']) ; 
$id = $_POST['nat_id'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$sql = "SELECT * FROM clients WHERE nat_id='$id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) { $mess = "User already exists" ;} 
else 
{
$nat_id = $_POST['nat_id'] ;
$f_name = $_POST['f_name'] ;
$l_name = $_POST['l_name'] ;
$location = $_POST['location'] ;
$mobile_no = $_POST['mobile_no'] ;
$gabbage_type = $_POST['gabbage_type'] ;

$password = md5($_POST['password']) ;


$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$sql = "INSERT INTO clients (nat_id,password,f_name,l_name,location,mobile_no,gabbage_type) 
                     VALUES ('$nat_id','$password','$f_name','$l_name','$location','$mobile_no','$gabbage_type')";
if ($conn->query($sql) === TRUE) {
$mes = "Successful Registered, Login now" ;
} else { }}
}
?>
<?php
if(empty($_POST['wer'])) { } 
elseif(empty($_POST['natid'])) { $mess = "National ID is missing" ;} 
elseif(empty($_POST['password'])) { $mess = "Password is missing" ; } 
else {
$pass = $_POST['password'] ; 
$pas = md5($pass);
$id = $_POST['natid'] ;
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }
$sql = "SELECT * FROM clients WHERE nat_id='$id' AND password='$pas'";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
session_start();
$_SESSION['clients_natid'] = $id ; 
header("location:clients.php");} 
else 
{
$sql = "SELECT * FROM admin WHERE username='$id' AND password='$pass'";
$result = $conn->query($sql);
if ($result->num_rows > 0) { 
session_start();
$_SESSION['admin_u_name'] = $id ;
header("location:admin.php");
} else 
{ $mess = "Incorrect National ID or Password" ;}
}
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
	<div id="menu">
		<ul>
			<li class="current_page_item"><a href="index.php">Home</a></li>
			<li><a href="index.php?page=1">Apply Here</a></li>
			<li><a href="index.php?page=2">Login</a></li>
			<li><a href="index.php?page=3">About Us</a></li>
			<li><a href="index.php?page=4">Contact Us</a></li>
		</ul>
	</div>
</div>
<!-- end #header -->
<?php 
if(empty($_GET['page'])){ include"home.php" ; } else 
{ 
if($_GET['page']==1) { include"apply.php" ; } 
elseif($_GET['page']==2) { include"login.php" ; } 
elseif($_GET['page']==3) { include"about.php" ; } 
elseif($_GET['page']==4) { include"contact.php" ; } 
else { }
}
?>
<div id="footer">
	<p>Garbage Collection Management System, All rights reserved.</p>
</div>
<!-- end #footer -->
</body>
</html>
