<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	session_destroy();
	unset($_SESSION['usr_id']);
	unset($_SESSION['usr_name']);
	unset($_SESSION['uclassname']);
	unset($_SESSION['usr_email']);
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>
