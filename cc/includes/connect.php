<?php
	$host= "localhost";
	$user="root";
	$password="";
	$db_name="cloud_storage";

	$con=mysqli_connect("$host","$user","$password")
            or die("Connecton Error with Server");

	$db_con=mysqli_select_db($con,"$db_name") or die("Database not connected.");
	$connection=new mysqli($host,$user,$password,$db_name);

?>