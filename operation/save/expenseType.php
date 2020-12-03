<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['expensetypename'])){
            $expensetypename = $_REQUEST['expensetypename'];
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
            $sql = "INSERT INTO  expense_types (expense_type_name,status) VALUES ('".$expensetypename."','".$status."')";
        }
        else{
            $sql = "UPDATE expense_types SET expense_type_name='".$expensetypename."',status='".$status."' WHERE expense_type_id=".$id;
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