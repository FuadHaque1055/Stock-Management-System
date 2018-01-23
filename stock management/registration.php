<?php
session_start();
// Connection with database
include('connection.php');
// Variable initializaiton
$user_name = '';
$user_email = '';
$user_password = '';
$error = '';
$success = '';




if(isset($_POST['btnAddUser'])){
    extract($_POST);
    
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    
    // Checking / Validate posted value
    if(empty($user_name)){
        $error = "Enter user name";
    }else if(empty($user_email)){
        $error = "Enter user email";
    }else if(empty($user_password)){
        $error = "Enter user password";
    }else{
        
        $sqlCheck = "SELECT * FROM user WHERE user_email='$user_email'";
        $resultCheck = mysqli_query($con,$sqlCheck);
        $countRows = mysqli_num_rows($resultCheck);
        if($countRows > 0){
            
            $error = "user already exists ";
        }else{
            // Insert data into table
            $sql = "INSERT INTO user (user_name,user_email,user_password) VALUES ('$user_name','$user_email','$user_password')";
            $result = mysqli_query($con,$sql);
            if($result){
            $_SESSION['user_email'] = $user_email ;
            header('Location: index.php');
            }else{
                $error = "Something went wrong";
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
<body background="img/reg.jpg">
     <!-- For error message -->
        <p style="color:red;"><?php echo $error; ?></p>
        <!-- For success message -->
        <p style="color:green;"><?php echo $success; ?></p>
     <div class="container">
        <img src="img/reg1.png">
        <form method="POST" action="">
            <div class="form-input">
                <input type="text" id="user_name" name="user_name" placeholder="Enter Name" value="<?php echo $user_name; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="email" id="user_email" name="user_email" placeholder="Enter Email" value="<?php echo $user_email; ?>" class="form-control"/>
            </div>
            <div class="form-input">
                <input type="password" id="user_password" name="user_password" placeholder="Enter Password" value="<?php echo $user_password; ?>" class="form-control"/>
            </div>

            <input type="submit" class="btn-success" name="btnAddUser" value="Add user"><br>
            
            <a href="index.php">Go Back</a>
        </form>
     </div>
</body>
</html>