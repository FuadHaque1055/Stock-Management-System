<?php 
include('connection.php');
$id ="";
if(isset($_GET['id'])){
	$id = $_GET['id'];
}
// Delete operation
$sql = "DELETE FROM product WHERE product_id=$id";
$result = mysqli_query($con,$sql);
if($result){
	header("Location:product.php");
}else{
	// show your message
	echo "Error for ".mysqli_error($con);
}
?>