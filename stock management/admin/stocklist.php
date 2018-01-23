<?php
include('connection.php');
$array = array();
$sql = "SELECT stock.*,product.*
FROM stock INNER JOIN product ON stock.stock_product_id = product.product_id
";

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
		<title>stock List</title>
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
			<th>Product Name</th>
			<th>Stock ID</th> 
			<th>Stock Quantity</th>
			<th>Action</th>
		  </tr>
 <?php foreach($array AS $product): ?>
		  <tr>
			<td><?php echo $product->product_name; ?></td>
			<td><?php echo $product->Stock_id; ?></td>
			<td><?php echo $product->stock_quantity; ?></td>
			<td>
				<a href="editstock.php?id=<?php echo $product->Stock_id; ?>">Edit</a>&nbsp;|&nbsp;
				<a href="delete2.php?id=<?php echo $product->Stock_id; ?>">Delete</a>
			</td>
		</tr>
		  <?php endforeach; ?>
		  </tr>
		  
		</table>
		<br>
		  <a href="stockform.php">Add new stock</a>
	</body>
</html>