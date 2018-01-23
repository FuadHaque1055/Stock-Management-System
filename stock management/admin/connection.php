<?php 
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'inventory';

$con = mysqli_connect($hostname,$username,$password,$database);
if(!$con){
	echo "Database connection error for ".mysqli_connect_error($con);
}
?>