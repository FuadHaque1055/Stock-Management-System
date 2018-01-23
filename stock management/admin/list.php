<?php
include('connection.php');
$array = array();
$sql = "SELECT * from product";
$result = mysqli_query($con,$sql);
if($result){
	while($obj = mysqli_fetch_object($result)){
		$array[] = $obj;
	}
}
echo "<pre>";
print_r($array);
echo "</pre>";
?>
<!DOCTYPE HTML>
<html>
	<head>
		
		<title>Product List</title>
		<style>
			table, th, td {
				border: 1px solid black;
				border-collapse: collapse;
			}
		</style>
	</head>
	<body>
	
		<table style="width:100%">
		  <tr>
			<th>Product ID</th>
			<th>Product Name</th>
			<th>Product Details</th> 
			<th>Product Code</th>
			<th>Product Price</th>
			<th>Action</th>
		  </tr>
		  <?php foreach($array AS $product): ?>
		  <tr>
			<td><?php echo $product->product_id; ?></td>
			<td><?php echo $product->product_name; ?></td>
			<td><?php echo $product->product_details ; ?></td>
			<td><?php echo $product->product_code; ?></td>
			<td><?php echo $product->product_price; ?></td>
			<td>
				<a href="edit.php?id=<?php echo base64_encode($product->product_id); ?>">Edit</a>&nbsp;|&nbsp;
				<a href="delete.php?id=<?php echo $product->product_id; ?>">Delete</a>
			</td>
		  </tr>
		  <?php endforeach; ?>
		  </tr>
		  
		</table>
		<br>
		  <a href="product.php">Add new product</a>
	</body>
</html>