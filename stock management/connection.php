<?php 
	// $hostname = 'localhost';
	// $username = 'root';
	// $password = '';
	// $database = 'inventory';
    
    //$con = mysqli_connect($hostname,$username,$password,$database);

$con = mysqli_connect('localhost','root','','inventory');
if(!$con){
	echo "Database connection error for ".mysqli_connect_error($con);
}
?>