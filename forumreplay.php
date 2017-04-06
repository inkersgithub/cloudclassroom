<?php
session_start();
include_once 'dbconnect.php';
if(isset($_SESSION['usr_id'])==""){
	header("Location: index.php");
}

if(!isset($_SESSION['uclassname'])){
	header("Location: index.php");
}

$threadid=mysql_real_escape_string($_GET['link']);
if($threadid==""){
header("Location:index.php");
}

$name = $_SESSION['usr_name'] . '|' . $_SESSION['usr_type'];
if (isset($_POST['replay'])){
   $answer = $_POST["txtarea"];
	 $threadid = $_POST["id"];
   if(mysqli_query($con, "INSERT INTO foruma(threadid,name,answer) VALUES('" . $threadid . "','" . $name . "','" . $answer . "')")) {
		 header("Location: forumreplay.php?link=$threadid");
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


<div class="container">

  <div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10" style=".overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 200px;">

			<?php
        $res = mysqli_query($con,"SELECT thread FROM forumq WHERE threadn='$threadid'");
        $row = mysqli_fetch_array($res);
				$thread = $row['thread'];
				echo "<br>";
        echo '<strong>'.$row['thread'].'</strong>';
      ?>

		</div>
		<div class="col-sm-1" >
		</div>
	</div>
</div>



<div class="container " style="margin-bottom: 40px;">
  <div class="row">
		<div class="col-sm-1">
		</div>
		<div class="col-sm-10" style="margin-top:10px; height :100%; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 208px;">
				<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="forumq">
				<div>


					<?php
		        $res = mysqli_query($con,"SELECT * FROM foruma WHERE threadid='$threadid' ORDER BY sn DESC");
		        if(mysqli_num_rows($res) == 0) {
		          echo "<br></br>";
		          echo "<h3 align='center'>No</h3>";
		          echo "<h3 align='center'>Replies</h3>";
							echo "<br></br>";
		        }
		        else {
		          while ($row = mysqli_fetch_array($res)) {
		            echo "<br>";
		            echo $row['answer'];
		            echo "<br><br>";
		            $value['current_date']=$row['date'];
		            echo $value['current_date'];
								echo "         #Replied by".$row['name'];
		            echo "<hr style = 'border-width:2px;'>";
		          }
		        }
		      ?>

					<textarea name="txtarea" rows="5" cols="29" class="form-control" id="msgn" style="resize: none; margin-top:15px; overflow-y:scroll;" ></textarea>
					<p></p>
					<input type="submit" name="replay" value="Replay" style="margin: auto; margin-bottom:10px; display: block;padding: 7px 89px;border-radius: 28px;" class="btn btn-primary" onClick="return empty()"/>
					<input name="id" type="hidden" value="<?php echo htmlspecialchars($_GET['link'], ENT_QUOTES); ?>">
				</div>
		</div>
		<div class="col-sm-1" >
		</div>
	</div>
</div>

<div class="footer" ><strong> <a href="https://www.inkers.in">inkers Inc.</a> </strong></div>

<script src="js/jqueryext.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
