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
//echo $uclassname;

?>
<!DOCTYPE html>
<html>
<head>
	<title>Teacher classroom | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM Teacher</a>
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

<!-- boothstrap three sections -->

<div class="container">
  <div class="row">
    <div class="col-sm-3" style="height :560px; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
      <h3 align="center"><u>Student requests</u></h3>

      <?php
        $res = mysqli_query($con,"SELECT sn, name, email, institute FROM request WHERE uclassname='$uclassname' AND status='0'");

        while ($row = mysqli_fetch_array($res)) {
          $sn = $row['sn'];
          echo "Name      : ".$row['name']."<br>";
          echo "Email     : ".$row['email']."<br>";
          echo "Institute : ".$row['institute']."<br><br>";
          echo '<input type="submit" name="accept'. $row['sn'] .'" value="Accept" class="btn btn-primary"/>  ';
          echo '<input type="submit" name="delete'. $row['sn'] .'" value="Delete" class="btn btn-primary"/><br>';



          if(isset($_POST['delete'.$sn])){
            mysqli_query($con,"UPDATE request SET status='2' WHERE sn='$sn'");
            header("Location: teacherclass.php");
          }
          if(isset($_POST['accept'.$sn])){
              mysqli_query($con,"UPDATE request SET status='1' WHERE sn='$sn'");
              header("Location: teacherclass.php");
          }

        }
      ?>

    </div>
    <div class="col-sm-6">
      <h3>Column 2</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
    <div class="col-sm-3" style="height :560px; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;">
      <h3 align="center"><u>Student requests</u></h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
    </div>
  </div>
</div>

<!-- Boothstrap three Sections Ended -->

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
