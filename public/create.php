<?php
//Main PHP back-end code section 

//Create session 
session_start();

//Collects database login details via external file link
require 'config.php';

//Declare input variables
$servicetitle = $_POST['iservicetitle']; 	
$servicesdesc = $_POST['iservicesdesc']; 	
$servicescost = $_POST['iservicescost']; 	
$servicedate = $_POST['iservicedate']; 	
$servicelength = $_POST['iservicelength']; 	
$service_end = $_POST['iservice_end']; 	

//When submit is pressed 
if (isset($_POST['submit_button'])) {

	//If user left any fields empty, send back to page
	if (empty($servicetitle) || empty($servicesdesc) || empty($servicescost) || empty($servicedate) || empty($servicelength) || empty($service_end)) { 
		$_SESSION['failedempty'] = 'errorempty';
		header("Refresh:0");
		exit(); //Ensures no infinite loop 
	}
	
	// Establish SQL statement for values to be inserted into databases table 
	try {
		$sql = "INSERT INTO subscription_form (sysUsers, servicetitle, servicesdesc, servicescost, servicedate, servicelength, service_end) 
		VALUES (:isysUsers, :iservicetitle, :iservicesdesc, :iservicescost, :iservicedate, :iservicelength, :iservice_end)";

		//Establish connection and bind variabes that correlates correctly with the SQL database table
		$statement = $connection->prepare($sql);
		$statement->bindValue('iservicetitle', $servicetitle);
		$statement->bindValue('iservicesdesc', $servicesdesc);
		$statement->bindValue('iservicescost', $servicescost);
		$statement->bindValue('iservicedate', $servicedate);
		$statement->bindValue('iservicelength', $servicelength);
		$statement->bindValue('iservice_end', $service_end);
		$statement->bindParam('isysUsers', $_SESSION['userid']);
		
		$statement->execute();
	}
	
	// Print any error found during process
	catch (PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
}


?>

<!-- Main HTML front-end code section -->

<head>
    <title>Create</title>
</head>

<!-- Navigation -->
<?php include "templates/header.php"; ?>

<div class="container">
	<div class="main_body">
		
		<!-- Empty fields error message -->
		<?php if(isset($_SESSION['failedempty'])) { ?>	
		<div class="alert alert-warning" role="alert">
			<p>Ensure all login fields are filled!</p>
		</div>
		<?php unset($_SESSION['failedempty']); ?>
		<?php } ?>
		
		<!-- Success message -->
		<?php if (isset($_POST['submit_button']) && $statement) { ?>
		<div class="alert alert-success" role="alert">	
			<p>Entry successfully added!</p>
		</div>
		<?php } ?>
		
		<!-- Heading -->
		<div class="heading_area">
			<h1>Create a service entry</h1>
		</div>
		
		<!-- Form -->
		<form method="post">
			<div class="form-group" id="form_spacing">
				<label for="artistname">Name of Service</label>
				<input type="text" class="form-control" name="iservicetitle">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktitle">Service description</label>
				<input type="text" class="form-control" name="iservicesdesc">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="workdate">Service cost</label>
				<input type="text" class="form-control" name="iservicescost">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktype">Service payment date</label>
				<input type="text" class="form-control" name="iservicedate">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktype">Service length/duration</label>
				<input type="text" class="form-control" name="iservicelength">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktype">Service end date (If applicable)</label>
				<input type="text" class="form-control" name="iservice_end">
			</div>

			<input type="submit" class="btn btn-primary" name="submit_button">
		</form>
	</div>
</div>

<!-- Footer -->
<?php include "templates/footer.php"; ?>