<?php
include('dbfile.php');
session_start();
$name="";
$province="";
$city="";
$country="";
$telephone="";
$postalcode="";
$salary="";  
    if(isset($_SESSION["name"])){
        $name = $_SESSION["name"];
    }
	if(isset($_SESSION["province"])){
		$province = $_SESSION["province"];
		}
	if(isset($_SESSION["city"])){
		$city = $_SESSION["city"];
	}
	if(isset($_SESSION["country"])){
		$country = $_SESSION["country"];
	}
	if(isset($_SESSION["telephone"])){
		$telephone = $_SESSION["telephone"];
	}
	if(isset($_SESSION["postalcode"])){
		$postalcode = $_SESSION["postalcode"];
	}
	if(isset($_SESSION["salary"])){
		$salary = $_SESSION["salary"];
	}
?>

<html>

<head>
<title>Confirmation Page</title>
<style>
body{align: center;}
h3{
	background-color:blue;
	color: white;
}

</style>
</head>

<body>
<div align="center">
<a href="index.php"> ADD INFORMATION</a>
<a href="listingpage.php"> LISTING PAGE</a>
</div>
<br>
<div align="center">
<h3> Your data is saved.Go to listing page to see.</h3>
</div>
<br>
<div align="center">
<form action="confirmationpage.php" method="POST">

<label>Name:</label> <?php echo $name;?>
<br>
<br>
<label>Province:</label> <?php echo $province;?>
<br>
<br>
<label>City:</label> <?php echo $city;?>
<br>
<br>
<label>Country:</label> <?php echo $country;?>
<br>
<br>
<label>Telephone:</label> <?php echo $telephone;?>
<br>
<br>
<label>Postal Code:</label> <?php echo $postalcode;?>
<br>
<br>
<label>Salary:</label> <?php echo $salary;?>


</div>
</form>
</body>
</html>


