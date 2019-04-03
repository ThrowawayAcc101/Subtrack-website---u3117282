<!doctype html>
<html lang="en">
	
	<head>
		
		 <!--  Metadata -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		
		<!--  BootstrapCDN CSS Link -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> 
		<link rel="stylesheet" type="text/css" href="assets/css/custom.css">
		
	</head>

<body>

<!--  Navigation Bar via Bootstrap -->
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="index.php">Home</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		
		<!--  Show header if logged in -->
		<?php if(isset($_SESSION['userid'])) { ?>
		<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
			<div class="navbar-nav">
				<a class="nav-link" href="create.php">Create</a>
				<a class="nav-link" href="show.php">View</a>
				<a class="nav-link" href="update.php">Update</a>
				<a class="nav-link" href="delete.php">Delete</a>
			</div>
		<?php } ?>
			
			<!--  Welcome login text -->
			<?php if(isset($_SESSION['userid'])) { ?>	
				<p class="text-white">Welcome <?php echo $_SESSION['userid']; ?></p>
			<?php } ?>
	
		</div>
		
		<!--  Login/Logout form area (Alignment via Bootstrap) -->
		<div id="button_area">
			<form method="post" action='login_script.php' class="d-inline";>		
				<input type="text"  name="iusername" placeholder="Username">
				<input type="password" name="iuserpass" placeholder="Password">
				<button type="submit" name="iuserlogin" class="btn btn-sm btn-light">Login</button>
			</form>
			<form action="logout_script.php " class="d-inline"; >
				<button type="submit" name="userlogout" class="btn btn-sm btn-light">Logout</button>
			</form>
			<a href="signup.php">
				<button type="button" class="btn btn-sm btn-light">Signup</button>
			</a>	
		</div>
			
	</nav>
</header>


	


