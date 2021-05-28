<?php
	session_start();
	//including dB conn
	include('dBConfig.php');
  session_destroy();
	header('Location: http://localhost/ALMS/loginform.php');
?>
