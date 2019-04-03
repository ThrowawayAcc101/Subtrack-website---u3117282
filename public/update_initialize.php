<?php
//Main PHP back-end section 
session_start();	

//Collects database login details via external file link
require 'config.php';
require 'common.php';

// Bind variables 
$servicetitle = $_POST['iservicetitle']; 	
$servicesdesc = $_POST['iservicesdesc']; 	
$servicescost = $_POST['iservicescost']; 	
$servicedate = $_POST['iservicedate']; 	
$servicelength = $_POST['iservicelength']; 	
$service_end = $_POST['iservice_end']; 	
$id = $_GET['id'];

//When submit is pressed 
if (isset($_POST['submit'])) {
	
	//If user left any fields empty, send back to page
	if (empty($servicetitle) || empty($servicesdesc) || empty($servicescost) || empty($servicedate) || empty($servicelength) || empty($service_end)) { 
		$_SESSION['failedempty'] = 'errorempty';
		header("Refresh:0");
		exit; //Ensures no infinite loop 
	} else
	
	try {

		// Establish SQL statement for values to be updated into databases table 
		$sql = "UPDATE subscription_form 
			SET servicetitle = :iservicetitle, 
			servicesdesc = :iservicesdesc, 
			servicescost = :iservicescost, 
			servicedate = :iservicedate, 
			servicelength = :iservicelength, 
			service_end = :iservice_end 
			WHERE id = :id";

		// Bind variables to SQL statements and execute   
		$statement = $connection->prepare($sql);
		$statement->bindValue('iservicetitle', $servicetitle);
		$statement->bindValue('iservicesdesc', $servicesdesc);
		$statement->bindValue('iservicescost', $servicescost);
		$statement->bindValue('iservicedate', $servicedate);
		$statement->bindValue('iservicelength', $servicelength);
		$statement->bindValue('iservice_end', $service_end);
		$statement->bindValue(':id', $id);
		$statement->execute();

	} 

	// Print any error found during process
	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
}

//Get the 'Edit' ID link  
try {
	$id = $_GET['id'];

	//Grab the entry ID, bind and execute 
	$sql = "SELECT * FROM subscription_form WHERE id = :id";
	$statement = $connection->prepare($sql);
	$statement->bindValue(':id', $id);
	$statement->execute();

	//Fetch results
	$fetch = $statement->fetch(PDO::FETCH_ASSOC);
	
} 

// Print any error found during process
catch(PDOExcpetion $error) {
	echo $sql . "<br>" . $error->getMessage();
}


?>
<!-- Main HTML front-end section -->

<head>
    <title>Updaing Entry #<?php echo $_GET['id']; ?></title>
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
		<?php if (isset($_POST['submit']) && $statement) { ?>
		<div class="alert alert-success" role="alert">	
			<p>Entry successfully updated!</p>
		</div>
		<?php } ?>
		
		<!-- Heading -->
		<div class="heading_area">
			<h1>Editing Entry #<?php echo $_GET['id']; ?></h1>
		</div>
		
		<!-- Form -->
		<form method="post">
			<div class="form-group" id="form_spacing">
				<label for="artistname">Name of service</label>
				<input type="text" class="form-control" name="iservicetitle" value="<?php echo escape($fetch['servicetitle']); ?>">
			</div>
			
			<div class="form-group" id="form_spacing">
				<label for="worktitle">Service description</label>
				<input type="text" class="form-control" name="iservicesdesc" value="<?php echo escape($fetch['servicesdesc']); ?>">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="workdate">Service cost</label>
				<input type="text" class="form-control" name="iservicescost" value="<?php echo escape($fetch['servicescost']); ?>">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktype">Service payment date</label>
				<input type="text" class="form-control" name="iservicedate" value="<?php echo escape($fetch['servicedate']); ?>">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktype">Service length/duration</label>
				<input type="text" class="form-control" name="iservicelength" value="<?php echo escape($fetch['servicelength']); ?>">
			</div>

			<div class="form-group" id="form_spacing">
				<label for="worktype">Service end date (If applicable)</label>
				<input type="text" class="form-control" name="iservice_end" value="<?php echo escape($fetch['service_end']); ?>">
			</div>

			<input type="submit" class="btn btn-primary" name="submit" value="Save">
		</form>
		
		
	</div>
</div>

<!-- Footer -->
<?php include "templates/footer.php"; ?>