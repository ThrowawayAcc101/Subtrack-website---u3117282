<?php
//Main PHP back-end code section 

//Create session 
session_start();

//Collects database login details via external file link
require "config.php";

// Connects to SQL database tabe and collects the user entries from the database based on that user  
// Bind variables and execute 
try {
	
	$sql = "SELECT * FROM subscription_form WHERE sysUsers = :isysUsers";

	$statement = $connection->prepare($sql);
	$statement->bindValue('isysUsers', $_SESSION['userid']);
	$statement->execute();
	
	// Returns data as a variable source
	$result = $statement->fetchAll();

// Print any error found during process
} catch(PDOException $error) {
	echo $sql . "<br>" . $error->getMessage();
}

// If the delete link is clicked
if (isset($_GET["id"])) {

	try {
		
		// Get ID link 
		$id = $_GET["id"];
		
		//Prepare delete statement from the entry ID, bind and execute 
		$sql = "DELETE FROM subscription_form WHERE id = :id";
		$statement = $connection->prepare($sql);
		$statement->bindValue(':id', $id);

		$statement->execute();
	} 
	
	//Print any error found during process
	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}	
	
	header('Location: delete.php');		
	$_SESSION['success'] = 'placeholder';
	
}


?>

<!-- Main HTML front-end section -->

<head>
    <title>Delete</title>
</head>


<!-- Navigation-->
<?php include "templates/header.php"; ?>

<div class="container">
	<div class="main_body">
		
		<!-- Heading -->
		<div class="heading_area">
			<h1>Select an entry delete from</h1>
		</div>
		
		<div class="form_fields">
			<?php foreach($result as $row) { ?>
			<div class="card">
			<p id="entry">
				<strong> Entry ID#: </strong> <?php echo $row['id']; ?> 
				<br> Name of Service: <?php echo $row['servicetitle']; ?>
				<br> Service description: <?php echo $row['servicesdesc']; ?>
				<br> Service cost: <?php echo $row['servicescost']; ?>
				<br> Service payment date: <?php echo $row['servicedate']; ?>
				<br> Service length/duration: <?php echo $row['servicelength']; ?>
				<br> Service end date (If applicable): <?php echo $row['service_end']; ?><br> 
				<a href=delete.php?id=<?php echo $row['id']; ?> class="text-primary"><b>Delete</b></a>
			</p>
			</div>
			<?php }; 
			?>
		</div>
		
	</div>
</div>

<!-- Delete-->
<?php include "templates/footer.php"; ?>