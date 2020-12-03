<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['attributename'])){
            $attributename = $_REQUEST['attributename'];
        }

        if(isset($_REQUEST['status'])){
            $status = $_REQUEST['status'];
        }
        
        if(isset($_REQUEST['saveType'])){
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        if($sType=='1'){
            $sql = "INSERT INTO attributes(attribute_name,status) VALUES ('".$attributename."','".$status."')";
        }
        else{
            $sql = "UPDATE attributes SET attribute_name ='".$attributename."', status ='".$status."' WHERE attribute_id=".$id;
        }
  
    if ($conn->query($sql) === TRUE)
        {
            $response["code"] = 1;
            $response["message"] = "successfully stored";
        } else {
            $response["code"] = 2;
            $response["message"] = mysqli_error($conn);
        }       
        echo json_encode($response);
        mysqli_close($conn);
} 
?>