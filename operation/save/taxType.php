<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['taxtypename'])){
            $taxtypename = $_REQUEST['taxtypename'];
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
            $sql = "INSERT INTO  tax_types (tax_type_name,status) VALUES ('".$taxtypename."','".$status."')";
        }
        else{
            $sql = "UPDATE tax_types SET tax_type_name='".$taxtypename."',status='".$status."' WHERE tax_type_id=".$id;
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