<?php
//Main PHP back-end code section 

//Create session and grab stored file details 
session_start();
require 'config.php';

//Declare variables 
$typelogin = $_POST['iusername'];
$typepass = $_POST['iuserpass'];
$usercode = $_POST['iusercode'];

//When login button is pressed 
if (isset($_POST['iuserlogin'])) {
	
	//Connect, fetch and bind user data from SQL database
	try {	
		$sql = "SELECT * FROM users WHERE sysUsers = :iusername AND sysPass = :iuserpass";
		$statement = $connection->prepare($sql);
		$statement->bindValue('iusername', $typelogin);
		$statement->bindValue('iuserpass', $typepass);
		$statement->execute();
		
		//If user left any fields empty, send back to page
		if (empty($typelogin) || empty($typepass)){
			$_SESSION['failedempty'] = '';
			header('Location: index.php?error=emptyfields');
			exit();
			
		//If username and password matches with a user database, create user session 
		} else if($statement->rowCount() > 0) {
			$_SESSION['userid'] = $_POST['iusername'];
		//Send back to homepage if there is no match
		} else {
			header('Location: index.php?error=nomatches');
			$_SESSION['failednomatches'] = '';
			exit();
		}
	}
	
	// Print any error found during process
	catch(PDOException $error) {
		echo $sql . "<br>" . $error->getMessage();
	}
	
	// Print any error found during process
	if(isset($_SESSION['userid'])) {
	header('Location: index.php?user=success');
	exit();

	} else {
		//echo 'Logged out (No current session)';
	}
	
}
?>