<?php
session_start();
include('connection.php');
$error = '';
$success = '';
$admin_email = '';
$admin_password = '';
if(isset($_POST['btnLogin'])){
    extract($_POST);
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    if(empty($admin_email)){
        $error = "Email Address Required";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($admin_password)){
        $error = "Password Required";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else{
        // Check information exists or not
        $sqlCheck = "SELECT * FROM admin WHERE admin_email='$admin_email' AND admin_password='$admin_password'";
        $resultCheck = mysqli_query($con,$sqlCheck);
        $countCheck = mysqli_num_rows($resultCheck);
        if($countCheck >0){
             $_SESSION['admin_email'] = $admin_email ;
             header('Location: product.php');
        }else{
            $error = "Invalid Email or Password";
            echo '<script type="text/javascript">alert("'.$error.'")</script>';
            
        }
         
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">
</head>
<body background="img/f1.jpg">
     <!-- For error message -->
       <!-- <p style="color:black;"><?php echo $error; ?></p>-->
        <!-- For success message -->
        <!--<p style="color:green;text-align: center;"><?php echo $success; ?></p>-->
     <div class="container">
        <img src="img/223.jpg">
        <form method="POST" action="">
            <div class="form-input">
                <input type="email" id="admin_email" name="admin_email" placeholder="Enter Admin Email" value="<?php echo $admin_email; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="password" id="admin_password" name="admin_password" placeholder="Enter Admin Password" value="<?php echo $admin_password; ?>" class="form-control"/>
            </div>
            <input type="submit" class="btn-success" name="btnLogin" value="Login"><a href="registration.php"><br>
            <h3><a href="registration.php">Register Now</a></p></h3><br>
            
        </form>
     </div>
</body>
</html>