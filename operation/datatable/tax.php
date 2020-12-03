<?php 
    include("../../db.php");
   
            ## Read value
            $draw = $_POST['draw'];//
            $row = $_POST['start'];//for page number(pagination)
            $rowperpage = $_POST['length']; // Rows display per page

            if(isset($_POST['search']['value'])){
               $searchValue = $_POST['search']['value']; 
            }
            $searchQuery = " ";
            if($searchValue != ''){
               $searchQuery = " and (tax_name like '%".$searchValue."%')  ";//or (subject_name like '%".$searchValue."%') Search value  from  design page
            }
            ## Total number of records without filtering
            $sel = mysqli_query($conn,"select count(*) as allcount FROM taxes tx
            INNER JOIN tax_types tt 
                  ON tx.tax_type_id = tt.tax_type_id 
            WHERE  tx.deleted_at IS NULL 
            AND tt.deleted_at IS NULL ");
            $records = mysqli_fetch_assoc($sel);
            $totalRecords = $records['allcount'];

            ## Total number of record with filtering
            $sel = mysqli_query($conn,"select count(*) as allcount FROM taxes tx
            INNER JOIN tax_types tt 
                  ON tx.tax_type_id = tt.tax_type_id 
            WHERE  tx.deleted_at IS NULL 
            AND tt.deleted_at IS NULL ".$searchQuery);
            $records = mysqli_fetch_assoc($sel);
            $totalRecordwithFilter = $records['allcount'];

            ## Fetch Actual records
            $empQuery = "SELECT tx.`tax_id`, 
            tx.`tax_type_id`, 
            tt.`tax_type_name`, 
            tx.`tax_name`, 
            tx.tax_percentage,
            tx.`status` 
            FROM   `taxes` tx 
            INNER JOIN tax_types tt 
                  ON tx.tax_type_id = tt.tax_type_id 
            WHERE  tx.deleted_at IS NULL 
            AND tt.deleted_at IS NULL ".$searchQuery." limit ".$row.",".$rowperpage;

            $empRecords = mysqli_query($conn, $empQuery);
            $data = array();
            //Refer assosiative array
            while ($row = mysqli_fetch_assoc($empRecords)) {
               $data[] = array( 
                  "taxname"=>$row['tax_name'],  //"key"=>$row['db_column_name']
                  "taxtypename"=>$row['tax_type_name'],
                  "taxpercentage"=>$row['tax_percentage'],
                  "status"=>$row['status'],
                  'action'=> '<div><button type="button" id="btnEdit"  class="btn btn-outline-primary" value="Edit" data-id="'.$row["tax_id"].'" data-taxtypename="'.$row["tax_type_id"].'" data-taxname="'. $row["tax_name"].'" data-taxpercentage="'.$row["tax_percentage"].'"  data-status="'. $row["status"].'" >Edit</button>,
                  <button type="button" id="btnDelete"  class="btn btn-outline-danger" value="Delete" data-id="'.$row["tax_id"].'" >Delete</button></div>'
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