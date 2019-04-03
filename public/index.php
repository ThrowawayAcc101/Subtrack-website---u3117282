<?php
//Main PHP back-end code section 

//Create session and grab stored file details 
session_start();
require 'login_script.php';

?>

<!-- Main HTML front-end code section -->

<head>
    <title>James's Collection</title>
</head>

<!-- Navigation -->
<?php include "templates/header.php"; ?>
	
<div class="container">
	
	<!-- Introduction section -->
	<div class="main_body">	
		<h1 class="display-1">Welcome to Subtrack</h1>
		<div class="inner_container">	
			<p>Subtrack is a simple web application that enables users keep track of their favourite subscribed subscription service though simple form sheets. Subtrack also allow users to:</p>
		</div>
		<ul>
			<li>Edit and change their data entry</li>
			<li>Delete any entry </li>
		</ul>
		
	<div class="error_container">
		<!-- Same password error message -->
		<div class="inner_container">
		<?php if(isset($_SESSION['failedempty'])) { ?>	
		<div class="alert alert-warning" role="alert">
			<p>Login Error! Ensure all login fields are filled!</p>
		</div>	
		<?php unset($_SESSION['failedempty']); ?>
		<?php } ?>
		</div>

		<div class="inner_container">
		<?php if(isset($_SESSION['failednomatches'])) { ?>	
		<div class="alert alert-warning" role="alert">
			<p>Login Error! No matches</p>
		</div>	
		<?php unset($_SESSION['failednomatches']); ?>
		<?php } ?>
		</div>
	</div>
		
	</div>
	
</div>

<!-- Footer -->
<?php include "templates/footer.php"; ?>
