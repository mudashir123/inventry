<?php 
    include("../../db.php");
 
	if(isset($_REQUEST['id'])){
		$id=$_REQUEST['id'];
	}
	$sql = "SELECT tax_id, tax_name, tax_percentage, status FROM taxes WHERE deleted_at is null and tax_id=".$id;
	$res = mysqli_query($conn,$sql);
	
	$result = array();
	while($row = mysqli_fetch_array($res)){
		array_push($result,array('taxid'=>$row['tax_id'],'taxname'=>$row['tax_name'],
		'status'=>$row['status']));
	}
	echo json_encode($result);
    mysqli_close($conn);  
//mid:10-08
?>