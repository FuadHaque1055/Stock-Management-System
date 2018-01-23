<?php 
    header('Content-type: application/json');
    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
    	case 'GET':
    		handleGetOperation();
    		break;
    	case 'POST':
    		$data = json_decode(file_get_contents('php://input'),true);  
    		handlePostOperation($data);
  		
    	    break;
    	case 'PUT':
    		$data = json_decode(file_get_contents('php://input'),true);
    		handlePutOperation($data);
    		break;
        case 'DELETE':
    		$data = json_decode(file_get_contents('php://input'),true);
    		handleDeleteOperation($data);
    		break;		
    	
    	default:
    		echo '{"result":"Not Suppoted"}';
    		break;
    }


   //GET Opertaion
    function handleGetOperation(){
    	include "db.php";

    	$sql = "SELECT * FROM admin";
    	$result = mysqli_query($conn,$sql);

    	if(mysqli_num_rows($result) > 0){
    		$rows = array();
    		while ($r = mysqli_fetch_assoc($result)) {
    			$rows["result"][] = $r;

    		}
    		echo json_encode($rows);


    	}else{
    		echo '{"result":"No data found"}';
    	}
    }
    //POST Operation
    function handlePostOperation($data){

    	include "db.php";

    	$admin_name = $data['admin_name'];
    	$admin_email= $data['admin_email'];
    	$admin_password= $data['admin_password']

    	$sql = "INSERT INTO admin(admin_name,admin_email,admin_password)VALUES('$admin_name','$admin_email','$admin_password')";
    	if (mysqli_query($conn,$sql)) {

    		echo '{"result":"Success"}';
    	}else{
    		echo '{"result":"Failed"}';
    	}


    }
    //Put Operation

     function handlePutOperation($data){

    	include "db.php";

        $id = $data["id"];
    	$name = $data['name'];
    	$phone = $data['phone'];

    	$sql = "UPDATE test_table SET name = '$name',phone='$phone',datetime = NOW() WHERE id = '$id'"; 
    	
    	if (mysqli_query($conn,$sql)) {

    		echo '{"result":"Success"}';
    	}else{
    		echo '{"result":"Failed"}';
    	}


    }

    //Delete Operation
      function handleDeleteOperation($data){

    	include "db.php";

        $id = $data["id"];
    	
    	$sql = "DELETE FROM test_table WHERE id = $id"; 
    	
    	if (mysqli_query($conn,$sql)) {

    		echo '{"result":"Success"}';
    	}else{
    		echo '{"result":"Failed"}';
    	}


    }



?>