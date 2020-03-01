<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 
 $vn = $_GET["vn"];
	





 $sql = "select * from diags where vn =  '".$startvn."'";





$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['icdcode'] = $row['icdcode'];
	$row_array['icdtype'] = $row['icdtype'];
	
	


    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);









?>
