<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['incometypename'])){
            $incometypename = $_REQUEST['incometypename'];
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
            $sql = "INSERT INTO  income_types (income_type_name,status) VALUES ('".$incometypename."','".$status."')";
        }
        else{
            $sql = "UPDATE income_types SET income_type_name='".$incometypename."',status='".$status."' WHERE income_type_id=".$id;
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