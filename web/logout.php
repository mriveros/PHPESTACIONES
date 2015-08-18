<?php 
	session_start(); 
	session_destroy(); 
	header("Location:http://192.168.0.99/web/PHPESTACIONES/login/acceso.html");
?>