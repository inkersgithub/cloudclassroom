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

if (isset($_POST['createclass'])){

    $email=$_SESSION['usr_email'];
    $classname = mysqli_real_escape_string($con, $_POST['classname']);
    $uclassname = $email . '.' . $classname;
    if(mysqli_query($con, "INSERT INTO teacherclass(email,classname,uclassname) VALUES('" . $email . "', '" . $classname . "', '" . $uclassname . "')")) {
      $successmsg = "Class Created Successfully <a href='index.php'>Click here to Login</a>";
    } else {
      $errormsg = "Error in registering...Please try again later!";
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

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="classcreationform">
				<fieldset>
					<legend>Create Class</legend>
          <div class="form-group">
						<label for="name">Class Name</label>
						<input type="text" name="classname" placeholder="Your Class Name" required class="form-control" />
					</div>
          <div class="form-group">
						<input type="submit" name="createclass" value="Create" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
      <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
</div>





<script src="js/popup.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
