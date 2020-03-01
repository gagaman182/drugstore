<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';




	 
 $startvn = $_GET["startvn"];
	// $startvn = '36418449';





 $sql = "select * from drugs where vn =  '".$startvn."'";





$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['drugcode'] = $row['drugcode'];
	$row_array['drugname'] = $row['drugname'];
	$row_array['unit'] = $row['unit'];
	
	


    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);

// print json_encode($rows);







?>
