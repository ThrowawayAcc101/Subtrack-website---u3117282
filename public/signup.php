<?php
//Main PHP back-end code section 

//Create session 
session_start();

//When signup-button is pressed 
if (isset($_POST['signup-button'])) {	
	
	//Collects database login details via external file link
	require 'config.php';
	
	//Declaring and linking form input variables 
	$gname = $_POST['uname']; 
	$gpass = $_POST['upass']; 
	$gpassComfirm = $_POST['upass-comfirm']; 
	
	//Fetches user data from database and execute 
	$query = $connection->prepare("SELECT sysUsers FROM users WHERE sysUsers = :uname");
	$query->bindValue('uname', $gname);
	$query->execute();
	
	//If user left any fields empty, send back to page
	if (empty($gname) || empty($gpass) || empty($gpassComfirm)){
		$_SESSION['failedempty'] = 'errorempty';
		header("Refresh:0");
		exit(); //Ensures no infinite loop 
	}
	//If username field matches another username from database, send back to page
	else if($query->rowCount() > 0){
		$_SESSION['failedmatching'] = 'errormatching';
		header("Refresh:0");
		exit(); //Ensures no infinite loop 
	} 
	//Password check - If user password and comfirm password fields does no match, send back to page 
	else if ($gpass !== $gpassComfirm) {
		$_SESSION['failedpass'] = 'errorpass';
		header("Refresh:0");
		exit(); //Ensures no infinite loop 
	} else {
		try {
			// Establish SQL statement for values to be inserted into databases table 
			$sql = "INSERT INTO users (sysUsers, sysPass) VALUES (:uname, :upass)";
				
			// Prepare, bind variables to input and execute data installation  
			$statement = $connection->prepare($sql);
			$statement->bindValue(':uname', $gname);
			$statement->bindValue(':upass', $gpass);
			$statement->execute();
			
		// Print any error found during process
		} catch(PDOException $error) {
			echo $sql . "<br>" . $error->getMessage();
		}
	}
}
?>

<!-- Main HTML front-end code section -->

<head>
    <title>Signup</title>
</head>

<!-- Navigation -->
<?php include "templates/header.php"; ?>

<!-- Body section -->
<div class="container">
	<div class="main_body">	
			<!-- Success message -->
			<?php if (isset($_POST['signup-button']) && $statement) { ?>
			<div class="alert alert-success" role="alert">
				<p>Thank you for signing up</p>
			</div>
			<?php } ?>

			<!-- Same password error message -->
			<?php if(isset($_SESSION['failedpass'])) { ?>	
			<div class="alert alert-warning" role="alert">
				<p>Password does not match! Make sure both password fields are correct!</p>
			</div>
			<?php unset($_SESSION['failedpass']); ?>
			<?php } ?>

			<!-- Empty fields error message -->
			<?php if(isset($_SESSION['failedempty'])) { ?>	
			<div class="alert alert-warning" role="alert">
				<p>Ensure all login fields are filled!</p>
			</div>
			<?php unset($_SESSION['failedempty']); ?>
			<?php } ?>

			<!-- Username arleady taken error message  -->
			<?php if(isset($_SESSION['failedmatching'])) { ?>
			<div class="alert alert-warning" role="alert">
				<p>The username already exisit! Please input a different username</p>
			</div>
			<?php unset($_SESSION['failedmatching']); ?>
			<?php } ?>
			
			<div class="heading_area">
				<h1>Signup - Create an Account</h1>
			</div>
			<form id="signup-form" method="post">
				
				<div class="form-group" id="form_spacing">
					<label>Username</label>
					<input type="text" class="form-control" id="uname" name="uname" placeholder="Username">
				</div>
				
				<div class="form-group" id="form_spacing">
					<label>Password</label>
					<input type="password" class="form-control" id="upass" name="upass" placeholder="Password">
				</div>
				
				<div class="form-group" id="form_spacing">
					<label>Comfirm Password</label>
					<input type="password" class="form-control" name="upass-comfirm" id="upass-comfirm" placeholder="Comfirm Password">
				</div>
				
				<button type="submit" class="btn btn-primary" name="signup-button">Signup</button>
			</form>
	</div>
</div>

<!-- Footer -->	
<?php include "templates/footer.php"; ?>