<?php
session_start();
include_once 'dbconnect.php';
if($_SESSION['usr_type']!="student" OR isset($_SESSION['usr_id'])==""){
  if($_SESSION['usr_type']=="teacher"){
    header("Location: teacher.php");
  }
  else {
    header("Location: index.php");
  }
}

if(!isset($_SESSION['uclassname'])){
	header("Location: index.php");
}

$uclassname=$_SESSION['uclassname'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Question bank | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="studentclass.php">VIRTUAL CLASSROOM : <?php echo $_SESSION['classname']; ?></a>
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
		<div class="col-sm-10" style="height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 536px;">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
      <h3 align="center"><u>Question bank</u></h3>

      <?php
        echo "<hr style = 'border-width:2px;'>";
        $res = mysqli_query($con,"SELECT * FROM qbank WHERE uclassname='$uclassname'");
        if(mysqli_num_rows($res) == 0) {
          echo "<br></br>";
          echo "<br></br>";
          echo "<h3 align='center'>No</h3>";
          echo "<h3 align='center'>Questions</h3>";
        }
        else {
          while ($row = mysqli_fetch_array($res)) {
            echo "<br># ".$row['question']."<br>";
          }
        }
      ?>

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
