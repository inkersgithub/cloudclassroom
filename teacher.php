<?php
session_start();
include_once 'dbconnect.php';
if($_SESSION['usr_type']!="teacher" OR isset($_SESSION['usr_id'])==""){
  if($_SESSION['usr_type']=="student"){
    header("Location: student.php");
  }
  else {
    header("Location: index.php");
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Teacher Home | CLOUD CLASSROOM</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
  <link rel="stylesheet" href="css/popup.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">CLOUD CLASSROOM Teacher</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
				<li><a href="logout.php">Log Out</a></li>
				<?php } else { ?>
				<li><a href="index.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<button id="newclass" class="btn btn-primary" >Create new class</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    <div class="row">
  		<div class="col-md-4 col-md-offset-4 well">
  			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="newclassform">
  				<fieldset>
  					<legend>Create new classroom</legend>

  					<div class="form-group">
  						<label for="name">Enter new class name</label>
  						<input type="text" name="newclassname" placeholder="class name" required class="form-control" />
  					</div>

  					<div class="form-group">
  						<input type="submit" name="createclass" value="Submit" class="btn btn-primary" />
  					</div>
  				</fieldset>
  			</form>
  			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
  		</div>
  	</div>
  </div>

</div>



<script src="js/popup.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
