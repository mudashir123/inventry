<?php 
    include("../../db.php");
 
	// if(isset($_REQUEST['id'])){
	// 	$id=$_REQUEST['id'];
	// }
	$sql = "SELECT tax_type_id,tax_type_name, status FROM tax_types WHERE deleted_at is null";
	$res = mysqli_query($conn,$sql);
	
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('taxtypeid'=>$row['tax_type_id'],'taxtypename'=>$row['tax_type_name'],'status'=>$row['status'],
		));
	}
	
	echo json_encode($result);
    mysqli_close($conn);  
//mid:10-08
?>