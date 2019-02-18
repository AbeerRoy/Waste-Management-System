<div id="wrapper">
	<div id="page">
<p>
<p>
		<div id="box2">
			<p>As previously observed within most organizations that deal with high income businesses most of its income generated from secondary material which is of less value,
			waste or primary produce of another organization it has also been observed that people hardly take a perfect account of the resources they own being that most are rather ignorant or less advised</p>
		
		</div>
		<div id="poptrox"> 
			<!-- start -->
			<ul id="gallery">
				<li class="nopad"><a href="index.php?page=1">	
	<img src="images/pic01.jpg" width="230" height="150" alt="" title="Apply now" /></a></li>
				<li><a href="index.php?page=2"><img src="images/pic02.jpg" width="230" height="150" alt="" title="Praesent scelerisque scelerisque erat" /></a></li>
				<li><a href="index.php"><img src="images/pic03.jpg" width="230" height="150" alt="" title="Integer sit amet pede vel arcu aliquet pretium" /></a></li>
			<li>Apply online here &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp &nbsp</li>  
				<li>Make Payments Online &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
			&nbsp &nbsp &nbsp &nbsp&nbsp &nbsp &nbsp </li>
                <li>Your Garbage gets collected</li>
			</ul>
		
		
		
		</div>
	
			<!-- end --> 
		</div>
		<p>
		<div id="box">
		<center>
			<p><h1>Latest News and Notisfications</h1></p>
			</center>
			<?php
$conn =mysqli_connect("localhost","root","","gabbage");
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error);}
$sql = "SELECT * FROM notice ORDER BY id";
$result = $conn->query($sql);
echo "
<div id='wrapper'>
	<div id='page'>
<p>
<p>
		<div id='box2'>" ;
if ($result->num_rows > 0) 
{ while($row = $result->fetch_assoc()) 
{
echo "<li>" . ucfirst($row["date"]) . "<br> - " . ucfirst($row["details"]) . "</li>";
}
} else {}
?>
		</div>
	</div>
</div>
</div>