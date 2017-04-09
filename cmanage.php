<?php
session_start();
include_once 'dbconnect.php';
if($_SESSION['usr_type']!="teacher" OR isset($_SESSION['usr_id'])=="" OR isset($_SESSION['uclassname'])==""){
  if($_SESSION['usr_type']=="student"){
    header("Location: student.php");
  }
  else {
    header("Location: index.php");
  }
}
$uclassname = $_SESSION['uclassname'];


if (isset($_POST['add'])) {

	$email = mysqli_real_escape_string($con, $_POST['email']);
	$result = mysqli_query($con, "SELECT * FROM users WHERE email = '" . $email. "'");

	if ($row = mysqli_fetch_array($result)) {
		$name = $row['name'];
		$institute = $row['institute'];
    $classname = $_SESSION['classname'];
    mysqli_query($con,"INSERT INTO studentclass(email,studentname,institute,classname,uclassname,teachername) VALUES('" . $email . "','" . $name . "','" . $institute . "', '" . $classname . "', '" . $uclassname . "', '" . $_SESSION['usr_name'] . "')");
    header('Location:cmanage.php');
  }else{
		$errormsg = "Student Not Found!!!";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Manage class | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM : <?php echo $_SESSION['classname'] ?></a>
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


<div class="container">
  <div class="row">
    <div class="col-sm-1">

		</div>
    <div class="col-sm-3" style="height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 536px;">

      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="classcreationform">
				<fieldset>
					<legend>Add Student</legend>
          <div class="form-group">
						<!-- <label for="name">Class Name</label> -->
						<input type="text" name="email" value="" placeholder="Student Email" required class="form-control" />
					</div>
          <div class="form-group">
						<input type="submit" name="add" value="Add" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
      <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>

      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="classcreationform">
        <fieldset>
          <legend>Remove Student</legend>
          <div class="form-group">
            <select name="entervalue" class="form-control">
            <option value="default">Select</option>
            <?php
            $sql = mysqli_query($con, "SELECT * From studentclass Where uclassname='$uclassname'");
            $row = mysqli_num_rows($sql);
            while ($row = mysqli_fetch_array($sql)){
              echo "<option value='". $row['email'] ."'>" .$row['studentname'] ."</option>" ;
            }
            ?>
            </select>
          </div>
          <div class="form-group">
            <input type="submit" name="remove" value="Remove" class="btn btn-primary" />
          </div>
        </fieldset>
      </form>
    </div>
		<div class="col-sm-6" style="height :100%; margin-left: 20px; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 536px;">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
      <h3 align="center"><u>Students</u></h3>
      <?php
       $result = mysqli_query($con,"SELECT * FROM studentclass WHERE uclassname='$uclassname'"); ?>
       <table style="width:100%" border="2">
         <thead>
           <tr>
             <th style="text-align: center;">Name</th>
             <th style="text-align: center;">Email</th>
             <th style="text-align: center;">Institute</th>
           </tr>
         </thead>
         <tbody>
           <?php
           while( $row = mysqli_fetch_assoc( $result ) ){
             echo "<tr style='text-align: center;'><td>{$row['studentname']}</td><td>{$row['email']}</td><td>{$row['institute']}\n";
           }
           ?>
         </tbody>
      </table>
		</div>
		<div class="col-sm-1" >

		</div>
	</div>
</div>



<div class="footer" style="position:absolute"><strong> <a href="https://www.inkers.in">inkers Inc.</a> </strong></div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
