<?php 
	session_start(); 
	session_destroy(); 
	header("Location:http://localhost/app/PHPESTACIONES/login/acceso.html");
?>