<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['unitname'])){
            $unitname = $_REQUEST['unitname'];
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
            $sql = "INSERT INTO units (unit_name,status) VALUES ('".$unitname."','".$status."')";
        }
        else{
            $sql = "UPDATE units SET unit_name='".$unitname."',status='".$status."' WHERE unit_id=".$id;
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