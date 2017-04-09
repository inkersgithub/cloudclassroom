<?php
session_start();
if($_SESSION['usr_type']!="admin" OR isset($_SESSION['usr_id'])==""){
  header('Location:index.php');
}

if (isset($_POST['mteacher'])){
  header("Location: manageteacher.php");
}

if (isset($_POST['mstudent'])){
  header("Location: managestudent.php");
}

if (isset($_POST['mclass'])){
  header("Location: manageclass.php");
}

if (isset($_POST['mforum'])){
  $enterforum = $_POST['enterforum'];
  if($enterforum!="default"){
    $_SESSION['uclassname']=$enterforum;
    $temp = explode('|',$enterforum);
    $classname = end($temp);
    $_SESSION['classname']=$classname;
    header("Location: forum.php");
  }
}

include_once 'dbconnect.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title>Admin | VIRTUAL CLASSROOM</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM</a>
		</div>
		<!-- menu items -->
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



<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
<div class="container">
  <div class="row">
    <div class="col-sm-2">

		</div>
		<div class="col-sm-8  " style="height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 350px;">
      <h3 align="center"><u>Admin</u></h3>
      <input type="submit" name="mteacher" value="Manage Teachers" class="btnext btnext-primary" style="min-width: 400px;"/><br>
      <input type="submit" name="mstudent" value="Manage Students" class="btnext btnext-primary" style="min-width: 400px;"/><br>
      <input type="submit" name="mclass" value="Manage classrooms" class="btnext btnext-primary" style="min-width: 400px;"/><br>
		</div>
		<div class="col-sm-2" >

		</div>
	</div>
</div>

<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
<div class="container">
  <div class="row">
    <div class="col-sm-2">

		</div>
		<div class="col-sm-8  " style=" margin-top:10px;height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 120px;">

      <div style="margin-top:30px;">
        <select name="enterforum" class="form-control">
        <option value="default">Select</option>
        <?php

        $sql = mysqli_query($con, "SELECT * FROM teacherclass");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){
        echo "<option  value='". $row['uclassname'] ."'>".$row['classname']. "-" .$row['teachername'] ."</option>" ;
        }
        ?>
        </select>
      </div>
      <input  type="submit" name="mforum" value="Manage Forum" class="btnext btnext-primary" style="min-width: 400px; margin-top:30px;"/><br>
		</div>
		<div class="col-sm-2" >

		</div>
	</div>
</div>


<div class="footer"><strong> <a href="https://www.inkers.in">inkers Inc.</a> </strong></div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
