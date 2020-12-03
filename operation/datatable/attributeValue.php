<?php 
    include("../../db.php");
    
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page

if(isset($_POST['search']['value'])){
   $searchValue = $_POST['search']['value']; // Search value  
}
if(isset($_POST['parent_id'])){
   $parent_id = $_POST['parent_id']; // Search value  
}
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (attribute_value like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from attribute_values where 
attribute_parent_id =$parent_id AND deleted_at is  null");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from attribute_values WHERE  
attribute_parent_id =$parent_id and deleted_at is  null ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from attribute_values where 
attribute_parent_id =$parent_id and deleted_at is  null ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "attributevalue"=>$row['attribute_value'],
       'action'=> '<div>
       <button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" data-id="'.$row["attribute_value_id"].'"
    data-attributevalue="'. $row["attribute_value"].'">Edit</button>,
   <button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" data-id="'.$row["attribute_value_id"].'" >Delete</button>
   </div>'
   );
}

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecordwithFilter,
  "iTotalDisplayRecords" => $totalRecords,
  "aaData" => $data
);

echo json_encode($response);
?>