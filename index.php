<?php
$nameErr = $provinceErr = $cityErr = $countryErr = $telephoneErr = $postalcodeErr = $salaryErr = "";
$name = $province = $city = $country = $telephone = $postalcode = $salary = "";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required. Minimum 2 characters";
  } else {
    $name = test_input($_POST["name"]);
	$_SESSION["name"] = $_POST["name"];
  }  
  $province = $_POST['province'];
  if (!isset($province)) {
    $provinceErr = "Must select at least one Province!";
  } else {
	  $province = count($province);
	  for($i=0;$i < $province;$i++)
    $province = test_input($_POST["province"]);
	$_SESSION["province"] = $_POST["province"];
  }
      if (empty($_POST["city"])) {
    $cityErr = "Please select a City!";
  } else {
    $city = test_input($_POST["city"]);
	$_SESSION["city"] = $_POST["city"];
  }
    if (empty($_POST["country"])) {
    $countryErr = "Please select a country!";
  } else {
    $country = test_input($_POST["country"]);
	$_SESSION["country"] = $_POST["country"];
  }
  if (empty($_POST["telephone"])) {
    $telephoneErr = "Please insert Telephone number! <br>
	Telephone must accept the following combination: <br>
	i. (416) 123-4567
	ii. (416)123-4567
	iii. 416-123-4567";
  } else {
    $telephone = test_input($_POST["telephone"]);
	$_SESSION["telephone"] = $_POST["telephone"];
  }
  if (empty($_POST["postalcode"])) {
    $postalcodeErr = "Please put a Postal Code!<br>
	Must accept following combination:<br>
i. M5G 2G8
ii. M52G8";
  } else {
    $postalcode = test_input($_POST["postalcode"]);
	$_SESSION["postalcode"] = $_POST["postalcode"];
  }
  if (empty($_POST["salary"])){
	  $salaryErr = "Put a salary! Must accept the following combination:<br>
	  i. 40000 (all provinces)<br>
	  ii. 40,000 (non Quebect)<br>
	  iii. 40 000 (Quebect only)<br>
	  iv. 40 000,00 (Quebec only)";
  } else {
	  $salary = test_input($_POST["salary"]);
	  $_SESSION["salary"] = $_POST["salary"];
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$con = mysqli_connect('127.0.0.1','root','','users');

if(!$con)
{
	echo 'Not connected to Server!';
}
if(!mysqli_select_db($con,'users'))
{
	echo 'Database Not Selected';
}
$sql = "INSERT INTO users (Name,Province,City,Country,Telephone,PostalCode,Salary) VALUES ('$name','$province','$city','$country','$telephone','$postalcode','$salary')";

if(!mysqli_query($con,$sql))
{
	echo 'Not inserted';
}
else
{
	header('Location: confirmationpage.php');
	exit;
}

?>
<!DOCTYPE HTML>  
<html>
<head>
<style>
input[type=text], select {
    width: 100%;
    padding: 12px 20px;
    margin: 6px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[class="input2"]{
	width: 35%;
    padding: 12px 20px;
    margin: 6px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
	
}
input[class="input3"]{
	width: 100%;
    padding: 12px 20px;
    margin: 6px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}
input[type=submit] {
    width: 20%;
    background-color: blue;
    color: white;
    padding: 15px 20px;
    margin: 8px 0;
    border: "";
    border-radius: 4px;
    cursor: pointer;
	align:right;
}

input[type=submit]:hover {
    background-color: blue;
}

form{
	background-color: white;
	 width: 50%;
    height: 850px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    font-size: 16px;
    resize: none;
	
}
.error {color: #FF0000;}
html{
	background-color: black;
}
header{
	background-color: white;
	height:10%;
}
</style>
</head>
<body>  
<header>
<h2 align="center">
<a href="index.php"> ADD INFORMATION</a>      <a href="listingpage.php">LISTING PAGE</a>
</h2>
</header>
<div align="center">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<p><span class="error">* required field.</span></p>
   Name<span class="error">* <?php echo $nameErr;?></span> <input type="text" name="name">
  <br><br>
  Province:<span class="error">* <?php echo $provinceErr;?></span> <br><select multiple="multiple" name="province">
  <option value=></option>
  <option value="Ontario">a.   Ontario</option>
  <option value="Quebec">b.   Quebec</option>
  <option value="Nova Scotia">c.   Nova Scotia</option>
  <option value="New Brunswick">d.  New Brunswick</option>
  <option value="Manitoba">e.  Manitoba</option>
  <option value="British Columbia">f.  British Columbia</option>
  <option value="Prince Edward Island">g.  Prince Edward Island</option>
  <option value="Saskatchewan">h.  Saskatchewan</option>
  <option value="Alberta">i.   Alberta</option>
  <option value="Newfoundland and Labrador">j.   Newfoundland and Labrador</option>
  <option value="Northwest Territories">k.   Northwest Territories</option>
  <option value="Yukon">l.   Yukon</option>
  <option value="Nunavut">m.   Nunavut</option>
  </select>
  <br><br>
   City: <span class="error">* <?php echo $cityErr;?></span> <input class="input2" type="text" name="city">
 <br><br>
   Country:<span class="error">* <?php echo $countryErr;?></span> <input class="input2" type="text" name="country">
  <br><br>
   Telephone:<span class="error">* <?php echo $telephoneErr;?></span> <input class="input2" type="text" name="telephone">
  <br><br>
  Postal Code:<span class="error">* <?php echo $postalcodeErr;?></span> <input class="input2"type="text" name="postalcode">
  <br><br>
    Salary:<span class="error">* <?php echo $salaryErr;?></span> <input class= "input3" type="text" name="salary">
  <br>
  <br>
  <input type="submit" name="submit" value="Submit">  
</form>
</div>
</div>
</div>
</body>
</html>