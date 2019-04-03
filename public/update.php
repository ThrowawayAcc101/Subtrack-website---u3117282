<?php
//Main PHP back-end section 

//Create session 
session_start();

//Collects database login details via external file link
require 'config.php';

// Collects the user entries from the database based on that user 
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

?>

<!-- Main HTML front-end section -->

<!-- Navigation -->
<?php include "templates/header.php"; ?>

<div class="container">
	<div class="main_body">
		
		<!-- Heading -->
		<div class="heading_area">
			<h1>Select a data entry to update</h1>
		</div>
		
		<!-- Entry cards -->
		<?php foreach($result as $row) { ?>
		<div class="card">
		<p id="entry">
			<strong>Entry ID#:</strong> <?php echo $row['id']; ?> 
			<br> Name of Service: <?php echo $row['servicetitle']; ?>
			<br> Service description: <?php echo $row['servicesdesc']; ?>
			<br> Service cost: <?php echo $row['servicescost']; ?>
			<br> Service payment date: <?php echo $row['servicedate']; ?>
			<br> Service length/duration: <?php echo $row['servicelength']; ?>
			<br> Service end date (If applicable): <?php echo $row['service_end']; ?><br> 
			<a href='update_initialize.php?id=<?php echo $row['id']; ?>' class="text-primary"><b>Edit</b></a>
		</p>
		</div>
		<?php }; 
		?>
		
	</div>
</div>

<!-- Footer -->
<?php include "templates/footer.php"; ?>