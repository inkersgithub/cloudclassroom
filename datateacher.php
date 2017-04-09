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

$uclassname = $_SESSION['uclassname'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Study materials | VIRTUAL CLASSROOM</title>
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
			<a class="navbar-brand" href="teacherclass.php">VIRTUAL CLASSROOM : <?php echo $_SESSION['classname'] ?></a>
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
		<div class="col-sm-10" style="height :100%; text-align:center; overflow-y:scroll; border-size:2px;border-style:solid; border-color:#e7e7e7; background-color: #f8f8f8;min-height: 536px;">
      <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="requeststatus" enctype="multipart/form-data">
      <h3 align="center"><u>Study materials</u></h3>
      <input type="text" name="filename" value="" placeholder="File name(if you want to show a different name)"  class="form-control" style="margin-top:30px" />
      <input type="text" name="filed" value="" placeholder="File Description"  class="form-control" style="margin-top:10px" />
      <input type="file" name="file" style="margin-top:10px">
      <input type="submit" class="btn btn-primary" name="upload" value="Upload file">
      <?php
        if(isset($_POST['upload'])){
          $file=$_FILES['file'];
          $filename=$_FILES['file']['name'];
          $filetmpname=$_FILES['file']['tmp_name'];
          $filesize=$_FILES['file']['size'];
          $fileerror=$_FILES['file']['error'];
          $filetype=$_FILES['file']['type'];

          $fgivename = mysqli_real_escape_string($con, $_POST['filename']);
          if($fgivename==""){
            $fgivename = array_shift(explode('.',$filename));
          }
          $description = mysqli_real_escape_string($con, $_POST['filed']);
          if($description==""){
            $description = "No Description";
          }
          $temp=explode('.',$filename);
          $fileext=strtolower(end($temp));
          $allowed = array('jpg','jpeg','png','pdf','docx','ppt','txt','mp3','mp4','avi');

          if(in_array($fileext,$allowed)){
            if($fileerror === 0){
              if($filesize < 10000000){
                  $filenewname = $fgivename.uniqid('',true).".".$fileext;
                  if (!is_dir('uploads/'.$_SESSION['uclassname'])) {
                    mkdir('uploads/'.$_SESSION['uclassname'], 0777, true);
                  }
                  $path = 'uploads/'.$_SESSION['uclassname'].'/'.$filenewname;
                  if(move_uploaded_file($filetmpname,$path)){
                    mysqli_query($con,"INSERT INTO data(uclassname,filename,path,type,description) VALUES('" . $uclassname . "', '" . $fgivename . "', '" . $path . "', '" . $filetype . "', '" . $description . "')");
                    header('Location:datateacher.php');
                  }

              }
              else {
                $errormsg = "Your file size is greater than 10M";
              }
            }
            else {
              $errormsg = "Error uploading file.Inconvenience regretted.";
            }
          }
          else {
            $errormsg = "Couldn't upload the file.Please check your file format.";
          }

        }

        echo "<hr style = 'border-width:2px;'>";
        $res = mysqli_query($con,"SELECT * FROM data WHERE uclassname='$uclassname'");
        if(mysqli_num_rows($res) == 0) {
          echo "<br></br>";
          echo "<br></br>";
          echo "<h3 align='center'>No</h3>";
          echo "<h3 align='center'>Data</h3>";
        }
        else {
        echo '<table style="width:100%" border="2">
            <thead>
              <tr>
                <th style="text-align: center;">Filename</th>
                <th style="text-align: center;">File Type</th>
                <th style="text-align: center;">Description</th>
                <th style="text-align: center;">Delete</th>

              </tr>
            </thead>
            <tbody>';
          while ($row = mysqli_fetch_array($res)) {
           $link ='<a href="' . $row['path'] . '">'.$row['filename'].'</a>';
           $delete= '<input style="text-align: center; margin-right: -9px;color: #cf0808; background-color: #f8f8f8; border-color: #f8f8f8;" type="submit" name="delete'. $row['sn'] .'" value="Remove" class="btn btn-primary"/><br>';
           echo "<tr><td>{$link}</td><td>{$row['type']}</td><td>{$row['description']}</td><td>{$delete}</td></tr>\n";
           $sn = $row['sn'];
           if(isset($_POST['delete'.$sn])){
             unlink($row['path']);
             mysqli_query($con,"DELETE FROM data WHERE sn='$sn'");
             header("Location: datateacher.php");
           }
          }
        }
        echo '</tbody>
          </table>
        </div>';
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
