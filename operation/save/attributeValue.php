<?php 
    include("../../db.php"); 
    if(isset($_REQUEST)){

        if(isset($_REQUEST['attributevalue'])){
            $attributevalue = $_REQUEST['attributevalue'];
        }
        
        if(isset($_REQUEST['saveType'])){
            $sType = $_REQUEST['saveType'];
        }
        if(isset($_REQUEST['id'])){
            $id = $_REQUEST['id'];
        }
        if(isset($_REQUEST['parent_id'])){
            $parent_id = $_REQUEST['parent_id'];
        }
        if($sType=='1'){
            $sql = "INSERT INTO attribute_values(attribute_value, attribute_parent_id) VALUES ('".$attributevalue."','".$parent_id."')";
        }
        else{
            $sql = "UPDATE attribute_values SET attribute_value ='".$attributevalue."' WHERE attribute_value_id=".$id;
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