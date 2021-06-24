<!-- Document -->
<!DOCTYPE html>
<!-- HTML root element -->
<html>
<!-- Head -->
		<html>
	<head>Fileio</head>
	<body>
	
		<?php
		    $firstName = $lastName = "";
		    $firstNameErr = $lastNameErr = "";
		    $username="";
			  $err_username="";
			  $password="";
			  $err_password="";
			  $Gender="";
			  $err_Gender="";
			  $Email="";
			  $err_Email="";
			  $Religion="";
			  $err_Religion="";
			  $phone="";
			  $err_phone="";
			  $PresentAddress="";
			  $err_PresentAddress="";
			  $PermanentAddress="";
			  $err_PermanentAddress="";
			if($_SERVER['REQUEST_METHOD'] === "POST") {
				$firstName = $_POST['firstName'];
				$lastName = $_POST['lastName'];
				if(empty($firstName)) 
				{
					$firstNameErr = "First name can not be empty!";
					$flag = true;
				}
				if(empty($lastName)) 
					{
						$lastNameErr = "Last name can not be empty!";
						$flag = true;
					}
			
			if($_SERVER['REQUEST_METHOD']== "POST"){
				if(empty($_POST["username"])){
					$err_username="*Username is  Required*";
				}
				else if(strlen($_POST["username"])<8){
					$err_usersername="*Username should be at least 6 characters";
				}
				else{
					$username=$_POST["username"];
				}
				if(empty($_POST["password"])){
					$err_password="*Password  is Required in this field";
				}
				else{
					$password=$_POST["password"];
				}
				if (!isset($_POST["Gender"])){
                    $err_gender=   "Select a gender  ";
                }
				else{
					if (isset($Gender) && $Gender=="Male"){
						$gender=$_POST["Gender"];
					}
					else{
						if (isset($Gender) && $Gender=="Female"){
							$Gender=$_POST["Gender"];
						}
				    }
				}
				if(empty($_POST["Email"])){
                    $err_Email="this field is required";
                        
                    }
                }
				else {
                    $Email=$_POST["Email"];
                }
				if(empty($_POST["Religion"])){
					$err_Religion="Select ";
				}
				
				else{
					$Religion=$_POST["Religion"];
				}
			}
			if(empty($Phone)) 
					{
						$err_phone = "phone can not be empty!";
						$flag = true;
					}
					if(empty($PermanentAddress)) 
					{
						$err_PermanentAddress= "Permanent Addres can not be empty!";
						$flag = true;
					}
					if(empty($PresentAddress)) 
					{
						$err_PresentAddress = "Present Address can not be empty!";
						$flag = true;
					}
			if(!$flag) 
			{
				$existing_data = read();
				if(empty($existing_data)) {
					$arr1[] = array("firstname" => $firstName, "lastname" => $lastName, "Email" => $Email, "Religion" => $Religion, "Gender" => $Gender, "Present Address" => $PresentAddress, "Permanent Address" => $PermanentAddress, "Phone" => $Phone, "Uname" => $Uname,"password" => $password,);
					$result = write(json_encode($arr1));
				}
				else {
					$existing_data_decode[] = json_decode($existing_data);
					array_push($existing_data_decode, array("firstname" => $firstName, "lastname" => $lastName, "Email" => $Email, "Religion" => $Religion, "Gender" => $Gender, "Present Address" => $PresentAddress, "Permanent Address" => $PermanentAddress, "Phone" => $Phone, "Uname" => $Uname,"password" => $password,));
					write("");
					$result = write(json_encode($existing_data_decode));
				}
				if($result) {
					$successfulMessage = "Successfully Saved!";
				}
				else {
					$errorMessage = "Error while saving!";
				}
			}
			?>
<?php
{
  function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  function write($content) {
    $fileName = "data.txt";
    $resource = fopen($fileName, "w");
    $fw = fwrite($resource, $content);
    fclose($resource);
    return $fw;
  }
  function read() {
    $fileName = "data.txt";
    $fileSize = filesize($fileName);
    $fr = "";
    if($fileSize > 0) {
      $resource = fopen($fileName, "r");
      $fr = fread($resource, $fileSize);
      fclose($resource);
      return $fr;
    }
  }
  } 
  ?>
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
		method="post">
	<from action="/action_page.php">
		<fieldset>
			<legend>Basic information:</legend>
	<br>
	<label for="firstName">First Name<span style="color: red;">*</span>: </label>
	<input type="text" name="firstName" id="firstName">
	<span style="color: red;"><?php echo $firstNameErr; ?></span>
	<br><br>
	<label for="lastName">Last Name<span style="color: red;">*</span>: </label>
	<input type="text" name="lastName" id="lastName">
	<span style="color: red;"><?php echo $lastNameErr; ?></span>
	<br><br>
	<label for="Religion">Religion<span style="color: red;">*</span>: </label>
	<select name="Religion">
		<option>Muslim</option>
		<option>Hindu</option>
		<option>Other</option>
	</select>
		<br><br>
		<label>Gender:<span style="color: red;">*</span>: </label>
		<td>:<input type="radio" value="<?php echo $Gender;?>" name="Gender">Male<input type="radio" value="<?php echo $Gender;?>" name="Gender">Female
			<span><?php echo $err_Gender;?></span>
			<br><br>
			<label for="dob">Enter your date of birth<span style="color: red;">*</span>: </label>
			<input type="text" id="dob" name="dob">
        <fieldset>
	        <legend>Contract information:</legend>
	 <br><br>
	<label for="Present Address">Present Address:</label>
	<textarea id="textarea" name="Present Address"></textarea>
	<br><br>
	<label for="Permanent Address">Permanent Address:</label>
	<textarea id="textarea" name="Permanent Address"></textarea>
	<br><br>
	<label for="lname">Email:<span style="color: red;">*</span>: </label>
	<input type="text" id="lname" name="lname">
	<br><br>
	<label for="lname">Phone:</label>
	<input type="text" id="lname" name="lname">
	<br>
	<fieldset>
	<legend>Account information:</legend>
	<form action="" method="post">
				<label><span User access: </span>:  
				<td><input type="text" placeholder="Username" value="<?php echo $username;?>" name="username">
				<?php echo $err_username;?><span style="color: red;">*</span>:</td>
				<br><br>
				<!--<td ><span>Password </span></td>-->
				<td><input type="password" placeholder="Password" value="<?php echo $password;?>" name="pass">
				<?php echo $err_password;?><span style="color: red;">*</span>: </td>
				<br><br>
</form>
</body>
<br><br>
<input type="submit" name="submit" value="Register">
<br>
</html

