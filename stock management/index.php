<?php
session_start();
include('connection.php');
$error = '';
$success = '';
$user_email = '';
$user_password = '';
if(isset($_POST['btnLogin'])){
    extract($_POST);
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    if(empty($user_email)){
        $error = "Email Address Required";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else if(empty($user_password)){
        $error = "Password Required";
        echo '<script type="text/javascript">alert("'.$error.'")</script>';
    }else{
        // Check information exists or not
        $sqlCheck = "SELECT * FROM user WHERE user_email='$user_email' AND user_password='$user_password'";
        $resultCheck = mysqli_query($con,$sqlCheck);
        $countCheck = mysqli_num_rows($resultCheck);
        if($countCheck >0){
             $_SESSION['user_email'] = $user_email ;
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
        <!--<p style="color:red;"><?php echo $error; ?></p>-->
        <!-- For success message -->
        <!--<p style="color:green;"><?php echo $success; ?></p>-->
     <div class="container">
        <img src="img/22.jpg">
        <form method="POST" action="">
            <div class="form-input">
                <input type="email" id="user_email" name="user_email" placeholder="Enter Email" value="<?php echo $user_email; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="password" id="user_password" name="user_password" placeholder="Enter password" value="<?php echo $user_password; ?>" class="form-control"/>
            </div>
            <input type="submit" class="btn-success" name="btnLogin" value="Login"><a href="registration.php"><br>
            <h3><a href="registration.php">Not Registered Yet?</a></p></h3><br>
            
        </form>
     </div>
</body>
</html>