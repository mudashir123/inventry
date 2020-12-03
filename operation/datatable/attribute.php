<?php 
    include("../../db.php");
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page

if(isset($_POST['search']['value'])){
   $searchValue = $_POST['search']['value']; // Search value  
}
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (attribute_name like '%".$searchValue."%') ";
}
## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from attributes where deleted_at is  null");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from attributes WHERE deleted_at is  null ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from attributes WHERE deleted_at is  null ".$searchQuery." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
   $data[] = array( 
      "attributename"=>$row['attribute_name'],
      "status"=>$row['status'],
       'action'=> '<div>
       <a href="attributeValue.php?parent_attribute_id='.$row["attribute_id"].'" class="btn btn-outline-secondary" data-id="'.$row["attribute_id"].'">+ Add Value</a>,
       <button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" data-id="'.$row["attribute_id"].'"
    data-attributename="'. $row["attribute_name"].'" data-status="'. $row["status"].'" >Edit</button>,
   <button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" data-id="'.$row["attribute_id"].'" >Delete</button>
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