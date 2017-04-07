<?php
session_start();
include_once 'dbconnect.php';
if(isset($_SESSION['usr_id'])==""){
	header("Location: index.php");
}

if(!isset($_SESSION['uclassname'])){
	header("Location: index.php");
}

$uclassname=$_SESSION['uclassname'];
$email = $_SESSION['usr_email'];

$name = $_SESSION['usr_name'] . '|' . $_SESSION['usr_type'];
if (isset($_POST['post'])){
   $thread = $_POST["txtarea"];
   if(mysqli_query($con, "INSERT INTO forumq(name,email,uclassname,thread) VALUES('" . $name . "','" . $email . "','" . $uclassname . "', '" . $thread . "')")) {
		 header("Location: forum.php");
   }
}



?>

<!DOCTYPE html>
<html>
<head>
	<title>Forum | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="index.php">VIRTUAL CLASSROOM Forum : <?php echo $_SESSION['classname'] ?></a>
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
		<div class="col-sm-10" style=".overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 200px;">

			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="forumq">
			<textarea name="txtarea" rows="5" cols="29" class="form-control" id="msgn" style="resize: none; margin-top:15px; overflow-y:scroll;" ></textarea>
      <p></p>
      <input type="submit" name="post" value="Post" style="margin: auto; margin-bottom:10px; display: block;padding: 7px 89px;border-radius: 28px;" class="btn btn-primary" onClick="return empty()"/>

		</div>
		<div class="col-sm-1" >
		</div>
	</div>
</div>
<div class="container " style="margin-bottom: 40px;">
  <div class="row" style="margin-bottom:20px">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10" style="margin-top:10px; height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 536px;">
			<?php
        $res = mysqli_query($con,"SELECT * FROM forumq WHERE uclassname='$uclassname' ORDER BY threadn DESC LIMIT 10");
        while ($row = mysqli_fetch_array($res)) {
					$threadn = $row['threadn'];
          echo "<br>";
      		echo '<strong>'.$row['thread'].'</strong>';
          echo "<br><br>";
          $value['current_date']=$row['date'];
          echo $value['current_date'];
					echo "        #Posted by ".$row['name'];
					$id=$row['threadn'];
					$result = mysqli_query($con,"SELECT * FROM foruma WHERE threadid='$id'");
					$num_rows = mysqli_num_rows($result);
					echo '<a style="float:right" href="forumreplay.php?link=' . $id . '">Reply #'.$num_rows.'</a>';
					if($_SESSION['usr_type']=="admin"){
						echo "<br>";
						echo '<input style="float:right; margin-right: -9px;color: #cf0808; background-color: #f8f8f8; border-color: #f8f8f8;" type="submit" name="delete'. $row['threadn'] .'" value="Remove" class="btn btn-primary"/><br>';
						if(isset($_POST['delete'.$threadn])){
							mysqli_query($con,"DELETE FROM forumq WHERE threadn='$threadn'");
							header("Location: forum.php");
						}
					}
					if($_SESSION['usr_email']==$row['email']){
						echo "<br>";
						echo '<input style="float:right; margin-right: -9px;color: #cf0808; background-color: #f8f8f8; border-color: #f8f8f8;" type="submit" name="delete'. $row['threadn'] .'" value="Remove" class="btn btn-primary"/><br>';
						if(isset($_POST['delete'.$threadn])){
							mysqli_query($con,"DELETE FROM forumq WHERE threadn='$threadn'");
							header("Location: forum.php");
						}
					}
					echo "<hr style = 'border-width:2px;'>";
					//if(isset($_POST['replay'.$threadn])){
          //  header("Location: forum.php");
        //  }
        }
      ?>
		</div>
		<div class="col-sm-1" >
		</div>
	</div>
</div>

<div class="footer"><strong> <a href="https://www.inkers.in">inkers Inc.</a> </strong></div>

<script src="js/jqueryext.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
