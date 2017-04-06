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

$uclassname=$_SESSION['uclassname'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Feedback | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM : <?php echo $_SESSION['classname']; ?></a></a>
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
      <h3 align="center"><u>Feedbacks</u></h3>
      <?php
        echo "<hr style = 'border-width:2px;'>";
        $res = mysqli_query($con,"SELECT * FROM feedback WHERE uclassname='$uclassname' AND status='0'");
        if(mysqli_num_rows($res) == 0) {
          echo "<br></br>";
          echo "<br></br>";
          echo "<br></br>";
          echo "<h3 align='center'>No</h3>";
          echo "<h3 align='center'>Feedback</h3>";
        }
        else {
          while ($row = mysqli_fetch_array($res)) {
            $sn=$row['sn'];
            echo $row['sname'].":<br>";
            echo $row['feedback'].".";
            echo '<textarea style="resize: none;  margin-top: 20px;" name="txtarea'. $row['sn'] .'" rows="1" cols="29" class="form-control" id="msgn"></textarea><br>';
            echo '<input type="submit" name="reply'. $row['sn'] .'" value="Reply" class="btn btn-primary" style="height:35px; width:35px" onClick="return empty()"/>  ';
            echo '<input type="submit" name="ignore'. $row['sn'] .'" value="Ignore" class="btn btn-primary" style="height:35px; width:35px"/>  ';
            echo "<hr style = 'border-width:2px;'>";

            if(isset($_POST['ignore'.$sn])){
              mysqli_query($con,"UPDATE feedback SET status='2' WHERE sn='$sn'");
              header("Location: feedback.php");
            }

            if(isset($_POST['reply'.$sn])){
              $msg=$_POST['txtarea'.$sn];
              mysqli_query($con,"UPDATE feedback SET reply='".$msg."',status='1' WHERE sn='".$sn."'");
              header("Location: feedback.php");
            }
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
<script src="js/jqueryext.js"></script>
</body>
</html>
