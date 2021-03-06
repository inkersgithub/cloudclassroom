<?php
session_start();
include_once 'dbconnect.php';
if($_SESSION['usr_type']!="student" OR isset($_SESSION['usr_id'])=="" OR isset($_SESSION['uclassname'])==""){
  if($_SESSION['usr_type']=="teacher"){
    header("Location: teacher.php");
  }
  else {
    header("Location: index.php");
  }
}
$uclassname=$_SESSION['uclassname'];
$sname=$_SESSION['usr_name'];
$email=$_SESSION['usr_email'];

if (isset($_POST['data'])){
  mysqli_query($con,"UPDATE studentclass SET dstatus='0' WHERE uclassname='$uclassname' AND email='$email'");
  header("Location: datastudent.php");
}

if (isset($_POST['qbank'])){
  mysqli_query($con,"UPDATE studentclass SET qbstatus='0' WHERE uclassname='$uclassname' AND email='$email'");
  header("Location: qbankstudent.php");
}

if (isset($_POST['mark'])){
  mysqli_query($con,"UPDATE studentclass SET mstatus='0' WHERE uclassname='$uclassname' AND email='$email'");
  header("Location: marksstudent.php");
}

if (isset($_POST['forum'])){
  mysqli_query($con,"UPDATE studentclass SET fstatus='0' WHERE uclassname='$uclassname' AND email='$email'");
  header("Location: forum.php");
}

if (isset($_POST['send'])){           //send feedback
  $msg=$_POST["txtarea"];
  if(mysqli_query($con,"INSERT INTO feedback(uclassname,sname,email,feedback) VALUES('" . $uclassname . "', '" . $sname . "', '" . $email . "', '" . $msg . "')")){
    $successmsg="Sent feedback";
  } else {
    $errormsg="You have already sent one feedback and teacher haven't seen it yet.";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Student classroom | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM : <?php echo $_SESSION['classname']; ?></a>
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
      <h3 align="center"><u>Notifications</u></h3>
      <?php
        $res = mysqli_query($con,"SELECT * FROM notification WHERE uclassname='$uclassname' ORDER BY sn DESC LIMIT 10");
        if(mysqli_num_rows($res) == 0) {
          echo "<br><br><br><br><br><br><br><br><br><br><br>";
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
    <div class="col-sm-6">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus">
      <h3 align="center"><u><?php echo $_SESSION['classname']; ?></u></h3>
      <?php

          $res = mysqli_query($con,"SELECT * FROM studentclass WHERE email='$email' AND dstatus='1'");
          if(mysqli_num_rows($res) == 0) {
            echo '<input type="submit" name="data" value="Study materials" class="btnext btnext-primary" /><br>';
          }else{
            echo '<input type="submit" name="data" value="Study materials" class="btnext btnext-primary" style="border-color: #36ad2a;" /><br>';
          }

          $res = mysqli_query($con,"SELECT * FROM studentclass WHERE email='$email' AND qbstatus='1'");
          if(mysqli_num_rows($res) == 0) {
              echo '<input type="submit" name="qbank" value="Question Bank" class="btnext btnext-primary" /><br>';
          }else{
              echo '<input type="submit" name="qbank" value="Question Bank" class="btnext btnext-primary" style="border-color: #36ad2a;" /><br>';
          }

          $res = mysqli_query($con,"SELECT * FROM studentclass WHERE email='$email' AND mstatus='1'");
          if(mysqli_num_rows($res) == 0) {
              echo '<input type="submit" name="mark" value="Mark/Attendence" class="btnext btnext-primary" /><br>';
          }else{
              echo '<input type="submit" name="mark" value="Marks/Attendence" class="btnext btnext-primary" style="border-color: #36ad2a;" /><br>';
          }

          $res = mysqli_query($con,"SELECT * FROM studentclass WHERE email='$email' AND fstatus='1'");
          if(mysqli_num_rows($res) == 0) {
              echo '<input type="submit" name="forum" value="Forum" class="btnext btnext-primary" /><br>';
          }else{
              echo '<input type="submit" name="forum" value="Forum" class="btnext btnext-primary" style="border-color: #36ad2a;" /><br>';
          }
      ?>
    </div>
    <div class="col-sm-3" style="height :540px; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;">
      <h3 align="center"><u>Feedback</u></h3>
      <textarea style="resize: none; overflow-y:scroll; margin-top: 20px;" name="txtarea" rows="5" cols="29" class="form-control" id="msgn"></textarea>
      <p></p>
      <input type="submit" name="send" value="Send" style="margin:auto; display:block; margin-top:5px;" class="btn btn-primary" onClick="return empty()"/>
      <br></br>
      <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
      <?php
        $res = mysqli_query($con,"SELECT * FROM feedback WHERE uclassname='$uclassname' AND email='$email'");
        if(mysqli_num_rows($res) == 0) {
          echo "<h3 align='center'>No</h3>";
          echo "<h3 align='center'>Feedback</h3>";
        }
        else {
          while ($row = mysqli_fetch_array($res)) {
            echo "<br>";
            echo "<hr style = 'border-width:2px;'>";
            if( $row['status']== 0){
              echo "Sent feedback:<br>";
              echo $row['feedback'];
            } elseif ($row['status']== 1) {
              echo "Sent feedback:<br>";
              echo $row['feedback'];
              echo "<br><br>";
              echo "Reply:";
              $reply=$row['reply'];
              echo "<br>";
              echo "<div  style='color:#008000'>$reply</div>";
              mysqli_query($con,"DELETE FROM feedback WHERE uclassname='$uclassname' AND email='$email'");
            } else{
              echo "<div  style='color:#ff0000'>Your sent feedback has been ignored by the teacher</div>";
              mysqli_query($con,"DELETE FROM feedback WHERE uclassname='$uclassname' AND email='$email'");
            }
            echo "<br><br>";
            echo "<hr style = 'border-width:2px;'>";
          }
        }
       ?>
    </div>


  </div>
</div>
<div class="footer"><strong> <a href="https://www.inkers.in">inkers Inc.</a> </strong></div>
<!-- Boothstrap three Sections Ended -->
<script src="js/jqueryext.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
