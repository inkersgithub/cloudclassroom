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
$classname = $_SESSION['classname'];

//echo $uclassname;
if (isset($_POST['notify'])){
   $msg = $_POST["txtarea"];
   if(mysqli_query($con, "INSERT INTO notification(uclassname,msg) VALUES('" . $uclassname . "', '" . $msg . "')")) {
     $successmsg="notified";
     header("Location: teacherclass.php");

   }
}

if (isset($_POST['data'])){
  header("Location: datateacher.php");
}

if (isset($_POST['qbank'])){
  header("Location: qbankteacher.php");
}

if (isset($_POST['mark'])){
  header("Location: marksteacher.php");
}

if (isset($_POST['forum'])){
  header("Location: forum.php");
}

if (isset($_POST['feedback'])){
  header("Location: feedback.php");
}
if (isset($_POST['cmanage'])){
  header("Location: cmanage.php");
}

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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM : <?php echo $_SESSION['classname'] ?></a>
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

<!-- bootstrap three sections -->

<div class="container">
  <div class="row">
    <div class="col-sm-3" style="height :540px; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
      <h3 align="center"><u>Join requests</u></h3>

      <?php

        $res = mysqli_query($con,"SELECT sn, name, email, institute FROM request WHERE uclassname='$uclassname' AND status='0'");
        if(mysqli_num_rows($res) == 0) {
          echo "<br><br><br><br><br><br><br><br><br><br><br><br>";
          echo "<h3 align='center'>No</h3>";
          echo "<h3 align='center'>Requests</h3>";
        }
        else {
          while ($row = mysqli_fetch_array($res)) {
            $sn = $row['sn'];
            echo "Name      : ".$row['name']."<br>";
            echo "Email     : ".$row['email']."<br>";
            echo "Institute : ".$row['institute']."<br><br>";
            echo '<input type="submit" name="accept'. $row['sn'] .'" value="Accept" class="btn btn-primary"/>  ';
            echo '<input type="submit" name="delete'. $row['sn'] .'" value="Reject" class="btn btn-primary"/><br>';
            if(isset($_POST['delete'.$sn])){
              mysqli_query($con,"UPDATE request SET status='2' WHERE sn='$sn'");
              header("Location: teacherclass.php");
            }
            if(isset($_POST['accept'.$sn])){
              mysqli_query($con,"UPDATE request SET status='1' WHERE sn='$sn'");
              mysqli_query($con,"INSERT INTO studentclass(email,studentname,institute,classname,uclassname,teachername) VALUES('" . $row['email'] . "','" . $row['name'] . "','" . $row['institute'] . "', '" . $classname . "', '" . $uclassname . "', '" . $_SESSION['usr_name'] . "')");
              header("Location: teacherclass.php");
            }
          }
        }
      ?>

    </div>
    <div class="col-sm-6">
      <h3 align="center"><u><?php echo $_SESSION['classname']; ?></u></h3>
      <input type="submit" name="data" value="Study material" class="btnext btnext-primary"/><br>
      <input type="submit" name="qbank" value="Question bank" class="btnext btnext-primary"/><br>
      <input type="submit" name="mark" value="Marks/Attendance" class="btnext btnext-primary"/><br>
      <input type="submit" name="forum" value="Forum" class="btnext btnext-primary"/><br>
      <?php
          $res = mysqli_query($con,"SELECT * FROM feedback WHERE uclassname='$uclassname' AND status='0'");
          if(mysqli_num_rows($res) == 0) {
              echo '<input type="submit" name="feedback" value="Feedback" class="btnext btnext-primary" /><br>';
          }else{
              echo '<input type="submit" name="feedback" value="Feedback" class="btnext btnext-primary" style="background-color: #19c507b3;border-color: #36ad2a;" /><br>';
          }
      ?>
      <input type="submit" name="cmanage" value="Manage Class" class="btnext btnext-primary"/><br>
    </div>

    <div class="col-sm-3" style="height :540px; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
      <h3 align="center"><u>Notify all</u></h3>
      <textarea style="resize: none; overflow-y:scroll;" name="txtarea" rows="5" cols="29" class="form-control" id="msgn"></textarea>
      <p></p>
      <input type="submit" name="notify" value="Notify" style="margin:auto; display:block; margin-top:5px;" class="btn btn-primary" onClick="return empty()"/>
      <br></br>
      <?php
        $res = mysqli_query($con,"SELECT * FROM notification WHERE uclassname='$uclassname' ORDER BY sn DESC LIMIT 10");
        if(mysqli_num_rows($res) == 0) {
          echo "<br></br>";
          echo "<h3 align='center'>No</h3>";
          echo "<h3 align='center'>Notifications</h3>";
        }
        else {
          while ($row = mysqli_fetch_array($res)) {
            echo "<br>";
            echo $row['msg'];
            echo "<br><br>";
            $value['current_date']=$row['date'];
            echo $value['current_date'];
            echo "<hr style = 'border-width:2px;'>";
          }
        }
      ?>

    </div>
  </div>
</div>

<div class="footer"><strong> <a href="https://www.inkers.in">inkers Inc.</a> </strong></div>

<!-- Boothstrap three Sections Ended -->


<script src="js/jquery-1.10.2.js"></script>
<script src="js/jqueryext.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
