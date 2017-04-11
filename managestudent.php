<?php
session_start();
if($_SESSION['usr_type']!="admin" OR isset($_SESSION['usr_id'])==""){
  header('Location:index.php');
}
include_once 'dbconnect.php';

if(isset($_POST['remove'])){
  $email = $_POST['email'];
  $result = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND type='student'");
  if(mysqli_num_rows($result) != 0) {
    $successmsg = "Removed Sucessfully";
    $tables = array("studentclass","feedback","foruma","forumq","request","users");
    foreach($tables as $table) {
      $query = "DELETE FROM $table WHERE email='$email'";
      mysqli_query($con,$query);
    }
  }else {
    $errormsg = "Invalid Email";
  }
}


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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM Admin</a>
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
    <div class="col-sm-1">

		</div>
		<div class="col-sm-10" style="height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 536px;">
      <h3 align="center"><u>Manage Students</u></h3>
      <?php
       $result = mysqli_query($con,"SELECT * FROM users WHERE type='student'"); ?>
       <table style="width:100%" border="2">
         <thead>
           <tr>
             <th>Name</th>
             <th>Email</th>
             <th>Institute</th>
           </tr>
         </thead>
         <tbody>
           <?php
           while( $row = mysqli_fetch_assoc( $result ) ){
             echo "<tr><td>{$row['name']}</td><td>{$row['email']}</td><td>{$row['institute']}\n";
           }
       ?>
         </tbody>
      </table>
		 </div>
		<div class="col-sm-1" >

		</div>
	</div>
</div>



<div class="footer" style="text-align: left;">
  <div class="col-sm-4">
  </div>
  <div class="col-sm-4">
    <input type="text" name="email" value="" placeholder="Student email" required class="form-control" />
  </div>
  <div class="col-sm-4">
    <input type="submit" name="remove" value="Delete" class="btn btn-primary" />
    <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
    <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
  </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
