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

// Getting all product 
$product_array = array();
$sqlproduct = "SELECT * FROM product";
$resultproduct = mysqli_query($con,$sqlproduct);
if($resultproduct){
    while($objproduct = mysqli_fetch_object($resultproduct)){
        $product_array[] = $objproduct;
    }
}

// Getting stock data 
if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$sqlstock = "SELECT * FROM stock WHERE Stock_id='$id'";
	$resultstock = mysqli_query($con,$sqlstock);
	if($resultstock){
	    while($objstock = mysqli_fetch_object($resultstock)){
	        $stock_array[] = $objstock;
	    }
	    $stock_info = $stock_array[0];
	}
} else {
	header("Location:stocklist.php");
}

// Post the value against button submit
if(isset($_POST['btnUpdateStock'])){
    // Assign posted value into variable
    $Stock_id = $_POST['Stock_id'];
    $stock_product_id = $_POST['stock_product_id'];
    $stock_quantity = $_POST['stock_quantity'];

    if(empty($stock_quantity)) {
        $error = "Enter Stock Quantity ";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    } else {
        // Insert data into table
        $sql = "UPDATE stock SET stock_quantity='$stock_quantity',stock_product_id='$stock_product_id' WHERE Stock_id='$Stock_id'";
        $result = mysqli_query($con,$sql);
        if($result){
            $success = "Information Saved Successfully";
            echo '<script type="text/javascript">alert("'.$success.'")</script>';
        }else{
            $error = "Something Went Wrong";
            echo '<script type="text/javascript">alert("'.$error.'")</script>';
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
       <!-- <p style="color:blue;"><?php echo $error; ?></p>-->
        <!-- For success message -->
        <!--<p style="color:blue;"><?php echo $success; ?></p>-->
     <div class="container">
        <img src="img/mms.jpg">
     	<form method="POST" action="editstock.php?id=<?php echo $stock_info->Stock_id; ?>">
            <input type="hidden" name="Stock_id" value="<?php echo $stock_info->Stock_id; ?>">
     		<div class="form-input">
     			<input type="number" class="form-control" id="stock_quantity" name="stock_quantity" placeholder="Enter Stock Quantity"  value="<?php echo($stock_info->stock_quantity); ?>" />
     		</div>
     		<div class="form-input">
                <select id="stock_product_id" name="stock_product_id" class="class-control">
                <option value=''>Choose Product</option>
                <?php foreach($product_array AS $product): ?>
                    <option value='<?php echo $product->product_id; ?>' <?php if($stock_info->stock_product_id==$product->product_id) echo "selected"; ?>><?php echo $product->product_name; ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <input type="submit" class="btn-success" name="btnUpdateStock" value="Update Stock" /><br>
     		<a href="stocklist.php">View Stock information</a><br><br>
            <a href="list.php">View Products</a><br>
            <a href="product.php">Add Products</a><br>
            <a href="logout.php">Logout Here</a>

     	
     	</form>
     </div>
</body>
</html>