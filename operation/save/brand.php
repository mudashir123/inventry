<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['brandname'])){
            $brandname = $_REQUEST['brandname'];
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
            $sql = "INSERT INTO  brands (brand_name,status) VALUES ('".$brandname."','".$status."')";
        }
        else{
            $sql = "UPDATE brands SET brand_name='".$brandname."',status='".$status."' WHERE brand_id=".$id;
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