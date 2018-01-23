<?php 
include('connection.php');
if(isset($_GET['id'])){
	$id = $_GET['id'];
	// Delete operation
	$sql = "DELETE FROM stock WHERE Stock_id=$id";
	$result = mysqli_query($con,$sql);
	if($result){
		header("Location:stocklist.php");
	}else{
		// show your message
		echo "Error for ".mysqli_error($con);
	}
} else {
	header("Location:stocklist.php");
}

?>