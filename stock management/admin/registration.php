<?php
session_start();
// Connection with database
include('connection.php');
// Variable initializaiton
$admin_name = '';
$admin_email = '';
$admin_password = '';
$error = '';
$success = '';




if(isset($_POST['btnAddadmin'])){
    extract($_POST);
    
    $admin_name = $_POST['admin_name'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    
    // Checking / Validate posted value
    if(empty($admin_name)){
        $error = "Enter Admin Name";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($admin_email)){
        $error = "Enter Admin Email";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($admin_password)){
        $error = "Enter Admin Password";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else{
        
        $sqlCheck = "SELECT * FROM admin WHERE admin_email='$admin_email'";
        $resultCheck = mysqli_query($con,$sqlCheck);
        $countRows = mysqli_num_rows($resultCheck);
        if($countRows > 0){
            
            $error = "Admin Already Exists ";
            echo '<script type="text/javascript">alert("'.$error.'")</script>';
        }else{
            // Insert data into table
            $sql = "INSERT INTO admin (admin_name,admin_email,admin_password) VALUES ('$admin_name','$admin_email','$admin_password')";
            $result = mysqli_query($con,$sql);
            if($result){
                $_SESSION['admin_email'] = $admin_email ;
                header('Location: product.php');
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
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body background="img/regg.png">
     <!-- For error message -->
        <!--<p style="color:red;"><?php echo $error; ?></p>-->
        <!-- For success message -->
       <!-- <p style="color:green;"><?php echo $success; ?></p>-->
     <div class="container">
        <img src="img/reg.png">
        <form method="POST" action="">
            <div class="form-input">
                <input type="text" id="admin_name" name="admin_name" placeholder="Enter Admin Name" value="<?php echo $admin_name; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="email" id="admin_email" name="admin_email" placeholder="Enter Admin Email" value="<?php echo $admin_email; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="password" id="admin_password" name="admin_password" placeholder="Enter Admin Password" value="<?php echo $admin_password; ?>" class="form-control"/>
            </div>

            <input type="submit" class="btn-success" name="btnAddadmin" value="Add admin"><br>
            
            <a href="index.php">Go Back</a>
        </form>
     </div>
</body>
</html>