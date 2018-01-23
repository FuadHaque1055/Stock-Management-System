<?php
// Connection with database
include('connection.php');

// Variable initializaiton
$product_name = '';
$product_details = '';
$product_code = '';
$product_price = '';
$error = '';
$success = '';
$id='';


if(isset($_GET['id'])){
	$id = base64_decode($_GET['id']);
}

if(isset($_POST['btnAddproduct'])){
	extract($_POST);
	
	$product_name = $_POST['product_name'];
	$product_details = $_POST['product_details'];
	$product_code = $_POST['product_code'];
	
	// Checking / Validate posted value
	if(empty($product_name)){
		$error = "Enter product name";
	}else if(empty($product_details)){
		$error = "Enter product details";
	}else if(empty($product_code)){
		$error = "Enter code";
	}else{
			// Insert data into table
			$sql = "UPDATE `product` SET product_name='$product_name',product_details='$product_details',product_code='$product_code',product_price='$product_price' WHERE product_id='$id'";
			$result = mysqli_query($con,$sql);
			if($result){
				$success = "product information saved sucessfully";
				echo '<script type="text/javascript">alert("'.$success.'")</script>';
			}else{
				$error = "Something went wrong";
				echo '<script type="text/javascript">alert("'.$error.'")</script>';
			}
		}
		
	}
	$sqlGet = "SELECT * FROM product WHERE product_id=$id";
	$resultGet = mysqli_query($con,$sqlGet);
	if($resultGet){
	$objGet = mysqli_fetch_object($resultGet);
	$product_name = $objGet->product_name;
	$product_details = $objGet->product_details;
	$product_code = $objGet->product_code;
	$product_price = $objGet->product_price;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body background="img/acx.jpg">
     <!-- For error message -->
        <!--<p style="color:red;"><?php echo $error; ?></p>-->
        <!-- For success message -->
      <!--  <p style="color:blue;"><?php echo $success; ?></p>-->

     <div class="container">
        <img src="img/f.jpg">
     	<form method="POST" action="">
     		<div class="form-input">
     			<input type="text" id="product_name" name="product_name"  placeholder="Enter Product Name" value="<?php echo $product_name; ?>" class="form-control"/>
     		</div>
     		<div class="form-input">
     			<input type="text" id="product_details" name="product_details" placeholder="Enter Product Details" value="<?php echo $product_details; ?>" class="form-control"/>
     		</div>
            <div class="form-input">
                <input type="text" id="product_code" name="product_code" placeholder="Enter Product Code" value="<?php echo $product_details; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="text" id="product_price" name="product_price" placeholder="Enter Product Price" value="<?php echo $product_price; ?>" class="form-control"/>
            </div>
            <input type="submit" class="btn-success" name="btnAddproduct" value="Add product" />
		</form>
		<br>
		<a style="color: black" href="list.php">View Product Information</a><br><br>
		<a style="color: black"  href="stockform.php">Add stock</a><br><br>
		<a style="color: black"  href="logout.php">Logout Here</a>
	 </div>
</body>
</html>

        
		