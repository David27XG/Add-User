<?php
include ('dbfile.php');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$sql = "SELECT Name, Province, City, Country, Telephone, PostalCode, Salary FROM users LIMIT 10 OFFSET 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) 
     echo "";     
}
 else {
    echo "0 results";
}
	 $conn->close();
				
?>

<html>

<head>
<title>Listing Page</title>

<meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
$(document).ready(function(){
    $("button").click(function(){
        $("#div1").load("listingpage2.php");
    });
});
</script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <style>
  thead {
    background-color: black;
	align: center;
}
  th{
	  color: white;
  }
  </style>
</head>
<body>
<br>
<div align="center">
<a href="index.php"> ADD INFORMATION</a>
<a href="listingpage.php"> LISTING PAGE</a>
</div>
<br>
<div class="container" align="center">
<form action="listingpage.php" method="POST">
<table class="table">
<thead>
      <tr>
        <th>Name</th>
        <th>Province</th>
		<th>City</th>
		<th>Country</th>
        <th>Telephone</th>
		<th>Postal Code</th>
		<th>Salary</th>
      </tr>
    </thead>
<tbody>
<div id="div1">
<?php 
    foreach ($result as $row){
        echo'<tr>'; 
        echo'<td>'. $row['Name'].'</td>';
        echo'<td>'. $row['Province'].'</td>';
		echo'<td>'. $row['City'].'</td>';
		echo'<td>'. $row['Country'].'</td>';
        echo'<td>'. $row['Telephone'].'</td>';
		echo'<td>'. $row['PostalCode'].'</td>';
		echo'<td>'. $row['Salary'].'</td>';
        echo'</tr>';
    }
?>
</div>
	  </tbody>
</table>
<br>
<br>
</form>
<br>
<footer>
<button>Load more Users.</button>  
</footer>  
</div>
</div>
</body>
</html>