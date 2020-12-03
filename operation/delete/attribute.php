<?php 
   include("../../db.php"); 

    $id=$_REQUEST['id'];
    //date_default_timezone_set("Asia/Kolkata");
    $cdt=date("Y-m-d H:i:s");
    $sql = "UPDATE `attributes` SET `deleted_at`='$cdt' WHERE attribute_id=".$id;
    //$sql = "DELETE FROM `cities` WHERE `id`=".$id;
	$res = mysqli_query($conn,$sql);

	$result = array();
		
  
    if ($conn->query($sql) === TRUE)
    {
        $response["code"] = 1;
        $response["message"] = "successfully deleted";
        
    } else {
        $response["code"] = 2;
        $response["message"] = mysqli_error($conn);
    }
    echo json_encode($response);
    mysqli_close($conn);   
?>