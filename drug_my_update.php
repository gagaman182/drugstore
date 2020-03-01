<?php
	 header('Access-Control-Allow-Origin: *');
   
	 include 'conn.php';



	 // $vn = '39440023';
	  $vn = $_GET["vn"];




 $sql = "SELECT * FROM drugs WHERE vn = '".$vn."'";


$return_arr = array();

if ($result = mysqli_query( $conn, $sql )){
    while ($row = mysqli_fetch_assoc($result)) {
	$row_array['CODE'] = $row['drugcode'];
	$row_array['NAME'] = $row['drugname'];
	$row_array['QUANTITY'] = $row['unit'];





    array_push($return_arr,$row_array);
   }
 }

mysqli_close($conn);

echo json_encode($return_arr);









?>
