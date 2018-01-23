<?php
// Connection with database
include('connection.php');
// Variable initializaiton
//$stock_product_id = '';
$stock_quantity = '';
$stock_product_id = '';
$Stock_id = '';
$error = '';
$success = '';

// Getting product 
$product_array = array();
$sqlproduct = "SELECT * FROM product";
$resultproduct = mysqli_query($con,$sqlproduct);
if($resultproduct){
	while($objproduct = mysqli_fetch_object($resultproduct)){
		$product_array[] = $objproduct;
	}
}


// Post the value against button submit
if(isset($_POST['btnAddStock'])){
	extract($_POST);
	//echo "<pre>";
	//print_r($_POST);
	//echo "</pre>";
	//exit();
	// Assign posted value into variable
	//$stock_product_id = $_POST['stock_product_id'];
	$product_id = $_POST['product_id'];
	$stock_quantity = $_POST['stock_quantity'];
	
	
	
	// Checking / Validate posted value
	/*if(empty($stock_product_id)){
		$error = "Enter ";
	}*/
	if(empty($stock_quantity)){
		$error = "Enter Stock Quantity";
		echo '<script type="text/javascript">alert("'.$error.'")</script>';
	/*}else if(empty($stock_product_id)){
		$error = "Enter ";
}	*/}else{
		// Check information exists or not
		$sqlCheck = "SELECT * FROM stock WHERE Stock_id='$Stock_id'";
		$resultCheck = mysqli_query($con,$sqlCheck);
		$countRows = mysqli_num_rows($resultCheck);
		if($countRows > 0){
			$error = "Stock already exists with provided ";
			echo '<script type="text/javascript">alert("'.$error.'")</script>';
		}else{
			// Insert data into table
			$sql = "INSERT INTO stock (stock_product_id, stock_quantity) VALUES ('$product_id', '$stock_quantity')";
			$result = mysqli_query($con,$sql);
			if($result){
				$success = "information saved successfully";
				echo '<script type="text/javascript">alert("'.$success.'")</script>';
			}else{
				$error = "Something went wrong";
				echo '<script type="text/javascript">alert("'.$error.'")</script>';
			}
		}
		
	}
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Stock Form</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body background="img/nssa.jpg">
        <!-- For error message -->
        <!--<p style="color:blue;"><?php echo $error; ?></p>-->
        <!-- For success message -->
       <!-- <p style="color:blue;"><?php echo $success; ?></p>-->
     <div class="container">
        <img src="img/mms.jpg">
     	<form method="POST" action="">
     		<div class="form-input">
     			<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter Stock Quantity"  value="<?php echo $stock_quantity; ?>" />
     		</div>
     		<div class="form-input">
     			<select id="product_id" name="product_id" class="class-control">
                <option value=''>Choose Product</option>
                <?php foreach($product_array AS $product): ?>
                    <option value='<?php echo $product->product_id; ?>'><?php echo $product->product_name; ?></option>
                <?php endforeach; ?>
            </select>
     		</div>
            <input type="submit" class="btn-success" name="btnAddStock" value="Add Stock" /><br>
     		<a href="stocklist.php">View Stock information</a><br><br>
            <a href="list.php">View Products</a><br>
            <a href="product.php">Add Products</a><br>
            <a href="logout.php">Logout Here</a>

     	
     	</form>
     </div>
</body>
</html>