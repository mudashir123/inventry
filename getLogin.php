<?php 
    include("db.php"); 


	$username = trim($_REQUEST['username']);
	$password =trim($_REQUEST['password']);

    $sql = "SELECT id, admin_name FROM admin_login where username='$username' and password='$password'";
	$res = mysqli_query($conn,$sql);
	
	$result = array();
	
	if(mysqli_num_rows($res) > 0){
	
		session_start();
		while($row = mysqli_fetch_array($res)){
			$_SESSION['admin_id'] = $row['id'];
			$_SESSION['name'] = $row['admin_name'];
			$_SESSION['user_type'] = "admin";
				header('Location: index.php');
		}
	
	}
	else{
		array_push($result,array('data'=>'not found'));
		$_SESSION['admin_id'] = "";
		$_SESSION['name']="";
		$_SESSION['user_type'] = "";
		header('Location: login.php?msg=1');
		
	}

	
    mysqli_close($con);
    
?>