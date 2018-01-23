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




if(isset($_POST['btnAddproduct'])){
    extract($_POST);
    
    $product_name = $_POST['product_name'];
    $product_details = $_POST['product_details'];
    $product_code = $_POST['product_code'];
    
    // Checking / Validate posted value
    if(empty($product_name)){
        $error = "Enter Product Name";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($product_details)){
        $error = "Enter Product Details";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($product_code)){
        $error = "Enter Product Code";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($product_price)){
        $error = "Enter Product Price";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else{
        
        $sqlCheck = "SELECT * FROM product WHERE product_code='$product_code'";
        $resultCheck = mysqli_query($con,$sqlCheck);
        $countRows = mysqli_num_rows($resultCheck);
        if($countRows > 0){
            $error = "product already exists with provied email address";
            echo '<script type="text/javascript">alert("'.$error.'")</script>';
        }else{
            // Insert data into table
            $sql = "INSERT INTO product (product_name,product_details,product_code,product_price) VALUES ('$product_name','$product_details','$product_code','$product_price')";
            $result = mysqli_query($con,$sql);
            if($result){
                $success = "Product Information Saved Sucessfully";
                echo '<script type="text/javascript">alert("'.$success.'")</script>';
            }else{
                $error = "Something Went Wrong";
                echo '<script type="text/javascript">alert("'.$error.'")</script>';
            }
        }
        
    }   
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Product</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body background="img/prod.jpg">
     <!-- For error message -->
       <!-- <p style="color:red;"><?php echo $error; ?></p>-->
        <!-- For success message -->
        <!--<p style="color:blue;"><?php echo $success; ?></p>-->

     <div class="container">
        <img src="img/mmm.jpg">
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
                <input type="text"id="product_price" name="product_price" placeholder="Enter Product Price" value="<?php echo $product_price; ?>" class="form-control"/>
            </div>


     		<input type="submit" class="btn-success" name="btnAddproduct" value="Add product" /><br>
            
            <a href="list.php">View Product Information</a><br><br>
            <a href="stockform.php">Add stock</a><br><br>
            <a href="logout.php">Logout Here</a><br><br>
            
     		
     	</form>
     </div>
</body>
</html>