<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['taxtypename'])){
            $taxtypename = $_REQUEST['taxtypename'];
        }
        if(isset($_REQUEST['taxname'])){
            $taxname = $_REQUEST['taxname'];
        }
        if(isset($_REQUEST['taxpercentage'])){
            $taxpercentage = $_REQUEST['taxpercentage'];
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
            $sql = "INSERT INTO  taxes (tax_type_id,tax_name,tax_percentage,status) VALUES ('".$taxtypename."','".$taxname."','".$taxpercentage."','".$status."')";
        }
        else{
            $sql = "UPDATE taxes SET tax_type_id='".$taxtypename."',tax_name='".$taxname."',tax_percentage='".$taxpercentage."' ,status='".$status."' WHERE tax_id=".$id;
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