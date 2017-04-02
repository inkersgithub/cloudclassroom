<?php
session_start();
include_once 'dbconnect.php';
$email=$_SESSION['usr_email'];
if($_SESSION['usr_type']!="student" OR isset($_SESSION['usr_id'])=="" ){
  if($_SESSION['usr_type']=="teacher"){
    header("Location: teacher.php");
  }
  else {
    header("Location: index.php");
  }
}
if(isset($_POST['request'])){
  $uclassname = $_POST['searchvalue'];
  $name = $_SESSION['usr_name'];
  $institute = $_SESSION['institute'];
  if($uclassname!="default"){
    if(mysqli_query($con, "INSERT INTO request(name,email,institute,uclassname) VALUES('" . $name . "', '" . $email . "', '" . $institute . "', '" . $uclassname . "')")) {

      $successmsg = "Request sent successfully!";

    } else {

      $errormsg = "Can't send request as you have already sent one";

    }
  }
}
if (isset($_POST['enterclass'])){
  $enterclass = $_POST['enterclass'];
  if($enterclass!="default"){
    $_SESSION[uclassname]=$enterclass;
    header("Location: studentclass.php");
  }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Home | VIRTUAL CLASSROOM</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM Student</a>
		</div>
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<?php if (isset($_SESSION['usr_id'])) { ?>
				<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
				<li><a href="logout.php">Log out</a></li>
				<?php } else { ?>
				<li><a href="index.php">Login</a></li>
				<li><a href="register.php">Sign Up</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</nav>

<!--class enter -->

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="classcreationform">
				<fieldset>
					<legend>Select classroom</legend>
          <div class="form-group">
            <select name="enterclass" class="form-control">
            <option value="default">Select</option>
            <?php

            $sql = mysqli_query($con, "SELECT * FROM studentclass WHERE email='$email'");
            $row = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_array($sql)){
            echo "<option value='". $row['uclassname'] ."'>".$row['teachername']. "-" .$row['classname'] ."</option>" ;
            }
            ?>
            </select>
					</div>
          <div class="form-group">
						<input type="submit" name="enter" value="Enter" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div>

<!--class enter ended -->

<!--class search -->

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="classcreationform">
				<fieldset>
					<legend>Search for your teacher</legend>
          <div class="form-group">
            <select name="searchvalue" class="form-control">
            <option value="default">Select</option>
            <?php
            $sql = mysqli_query($con, "SELECT * From teacherclass");
            $row = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_array($sql)){
              echo "<option value='". $row['email'] ."|" . $row['classname'] . "'>".$row['teachername']. "-" .$row['classname'] ."</option>" ;
            }
            ?>
            </select>
					</div>
          <div class="form-group">
						<input type="submit" name="request" value="Request entry" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
      <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
		</div>
	</div>
</div>

<!--class search ended -->


<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
